<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

/**
 * TapService
 *
 * Usage:
 *   $tap = new \App\Services\TapService();
 *   $resp = $tap->createCharge($payloadArray);
 *
 * The $payloadArray can be exactly the JSON you used in curl (associative array).
 */
class TapService
{
    protected string $base;
    protected ?string $secret;
    protected string $accept = 'application/json';

    public function __construct()
    {
        // prefer config('tap.*') if you set the config file; fallback to env
        $this->base   = 'https://api.tap.company/v2'; //config('tap.base_url', env('TAP_BASE_URL', 'https://api.tap.company/v2'));
        $this->secret = config('tap.secret_key', env('TAP_SECRET_KEY'));
    }

    /**
     * Create a charge (hosted or token/card based depending on payload.source.id)
     *
     * @param array $payload  The full Tap create charge payload (associative array).
     *                        Example keys: amount, currency, customer, source, redirect, post, etc.
     *
     * @return array ['ok' => bool, 'status' => int, 'data' => array|null, 'error' => array|null]
     */
    public function createCharge(array $payload): array
    {
        $data = [
            "amount" => 1000,
            "currency" => "KWD",
            "customer_initiated" => true,
            "threeDSecure" => true,
            "save_card" => false,
            "description" => "Test Description",
            "metadata" => [
                "udf1" => "Metadata 1"
            ],
            "receipt" => [
                "email" => false,
                "sms" => true
            ],
            "reference" => [
                "transaction" => "txn_01",
                "order" => "ord_01"
            ],
            "customer" => [
                "first_name" => "test",
                "middle_name" => "test",
                "last_name" => "test",
                "email" => "test@test.com",
                "phone" => [
                    "country_code" => 880,
                    "number" => "01516175214"
                ]
            ],
            "merchant" => [
                "id" => "1234"
            ],
            "source" => [
                "id" => "token_id",   // Replace with a real card token
                "card" => "15445445478444"
            ],
            "post" => [
                "url" => "http://your_website.com/post_url"
            ],
            "redirect" => [
                "url" => "http://your_website.com/redirect_url"
            ]
        ];

        // dd($data);
        // if (empty($this->secret)) {
        //     $msg = 'TAP secret key not configured.';
        //     Log::error('TapService.createCharge: '.$msg);
        //     return ['ok' => false, 'status' => 500, 'error' => ['message' => $msg]];
        // }

        // // Ensure minimal defaults if missing
        // $payload = $this->normalizePayload($payload);

        try {

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->secret}",
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->post($this->base.'/charges', $data);

            dd($response->json(), 'hi');
            
            // Primary attempt using withToken()
            $response = Http::withToken($this->secret)
                ->accept($this->accept)
                ->post($this->base . '/charges', $payload);

            // If server/proxy stripped Authorization header, try manual header fallback
            if ($response->status() === 401) {
                Log::warning('TapService.createCharge: received 401 with withToken(), trying manual header fallback.');
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->secret,
                    'Accept'        => $this->accept,
                    'Content-Type'  => 'application/json',
                ])->post($this->base . '/charges', $payload);
            }

            $status = $response->status();
            $body = $response->json() ?? ['raw' => $response->body()];
            // Log details (mask secret)
            Log::info('TapService.createCharge request', [
                'url' => $this->base . '/charges',
                'payload' => Arr::except($payload, ['customer.phone', 'customer.email']), // reduce log noise
                'status' => $status,
                'response' => is_array($body) ? $this->limitArray($body) : $body,
            ]);

            if ($response->successful()) {
                return ['ok' => true, 'status' => $status, 'data' => $body];
            }

            // Non 2xx — return body for debugging
            return ['ok' => false, 'status' => $status, 'error' => $body];
        } catch (\Throwable $e) {
            Log::error('TapService.createCharge exception', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return ['ok' => false, 'status' => 500, 'error' => ['message' => 'Unexpected error', 'exception' => $e->getMessage()]];
        }
    }

    /**
     * Retrieve a charge by tap charge id
     *
     * @param string $tapId
     * @return array
     */
    public function retrieveCharge(string $tapId): array
    {
        if (empty($this->secret)) {
            return ['ok' => false, 'status' => 500, 'error' => ['message' => 'TAP secret key not configured.']];
        }

        try {
            $response = Http::withToken($this->secret)
                ->accept($this->accept)
                ->get($this->base . '/charges/' . $tapId);

            $status = $response->status();
            $body = $response->json() ?? ['raw' => $response->body()];

            Log::info('TapService.retrieveCharge', ['tap_id' => $tapId, 'status' => $status]);

            if ($response->successful()) {
                return ['ok' => true, 'status' => $status, 'data' => $body];
            }

            return ['ok' => false, 'status' => $status, 'error' => $body];
        } catch (\Throwable $e) {
            Log::error('TapService.retrieveCharge exception', ['message' => $e->getMessage()]);
            return ['ok' => false, 'status' => 500, 'error' => ['message' => $e->getMessage()]];
        }
    }

    /**
     * Refund a charge (partial or full)
     *
     * @param string $tapId
     * @param float|null $amount  Amount in decimal (if null, Tap will refund full amount)
     * @param string $reason
     * @return array
     */
    public function refundCharge(string $tapId, ?float $amount = null, string $reason = 'requested_by_customer'): array
    {
        if (empty($this->secret)) {
            return ['ok' => false, 'status' => 500, 'error' => ['message' => 'TAP secret key not configured.']];
        }

        $payload = ['reason' => $reason];
        if ($amount !== null) {
            $payload['amount'] = (float)$amount;
        }

        try {
            $response = Http::withToken($this->secret)
                ->accept($this->accept)
                ->post($this->base . "/charges/{$tapId}/refund", $payload);

            $status = $response->status();
            $body = $response->json() ?? ['raw' => $response->body()];

            Log::info('TapService.refundCharge', ['tap_id' => $tapId, 'status' => $status, 'payload' => $payload]);

            if ($response->successful()) {
                return ['ok' => true, 'status' => $status, 'data' => $body];
            }

            return ['ok' => false, 'status' => $status, 'error' => $body];
        } catch (\Throwable $e) {
            Log::error('TapService.refundCharge exception', ['message' => $e->getMessage()]);
            return ['ok' => false, 'status' => 500, 'error' => ['message' => $e->getMessage()]];
        }
    }

    /**
     * Normalize or set sensible defaults for payload to avoid Tap validation errors.
     *
     * @param array $payload
     * @return array
     */
    protected function normalizePayload(array $payload): array
    {
        // Ensure currency exists
        if (!isset($payload['currency'])) {
            $payload['currency'] = config('tap.currency', env('TAP_CURRENCY', 'KWD'));
        }

        // Ensure amount exists (if missing, set to 1.00 for quick test)
        if (!isset($payload['amount'])) {
            $payload['amount'] = 1;
        }

        // Ensure source exists (if you intend hosted page, use src_all)
        if (!isset($payload['source']) || !isset($payload['source']['id'])) {
            $payload['source'] = ['id' => 'src_all'];
        }

        // Ensure redirect/post are set to something (Tap may require redirect)
        if (!isset($payload['redirect']) || !isset($payload['redirect']['url'])) {
            $payload['redirect'] = ['url' => env('TAP_REDIRECT_URL', env('APP_URL') . '/payments/result')];
        }
        if (!isset($payload['post']) || !isset($payload['post']['url'])) {
            $payload['post'] = ['url' => env('TAP_POST_URL', env('APP_URL') . '/api/v1/tap/webhook')];
        }

        return $payload;
    }

    /**
     * Small helper to limit depth/size of arrays logged
     */
    protected function limitArray(array $arr, int $limit = 200): array
    {
        $serialized = json_encode($arr);
        if ($serialized === false) {
            return $arr;
        }
        if (strlen($serialized) <= $limit) {
            return $arr;
        }
        return ['_truncated' => substr($serialized, 0, $limit) . '...'];
    }
}
