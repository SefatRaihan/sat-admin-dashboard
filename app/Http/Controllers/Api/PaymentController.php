<?php

namespace App\Http\Controllers\Api;

use App\Models\Payment;
use App\Services\TapService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    private TapService $tap;

    public function __construct(TapService $tap)
    {
        $this->tap = $tap;
    }

    public function createCharge(Request $request)
    {
        $v = Validator::make($request->all(), [
            'package_no' => 'required|string',
            'amount'   => 'required|numeric|min:0.1',
            'customer' => 'required|array',
            // 'customer.first_name' => 'required|string',
            // 'customer.email' => 'required|email',
        ]);

        if ($v->fails()) {
            return response()->json(['ok' => false, 'errors' => $v->errors()], 422);
        }
        DB::beginTransaction();
        // create local payment record (adjust fields as needed)
        $payment = Payment::create([
            'package_code' => $request->package_no,
            'amount'   => (int) round($request->amount * 100), // store minor units if you want
            'currency' => config('tap.currency'),
            'status'   => 'initiated',
        ]);

        $payload = [
            'amount' => (float) $request->amount,
            'description' => 'Order '.$payment->package_no,
            'metadata' => ['package_no' => $payment->order_no, 'payment_id' => (string)$payment->id],
            'customer' => $request->input('customer'),
        ];

        $charge = $this->tap->createCharge($payload);

        if (!$charge) {
            return response()->json(['ok' => false, 'message' => 'Failed to create charge'], 500);
        }

        // save returned charge id & payload
        $payment->update([
            'tap_charge_id' => $charge['id'] ?? null,
            'tap_payload' => $charge,
        ]);

        // return the transaction url to the frontend
        $transactionUrl = data_get($charge, 'transaction.url');
        DB::commit();
        return response()->json([
            'ok' => true,
            'payment' => $payment,
            'charge'  => $charge,
            'transaction_url' => $transactionUrl,
        ], 201);
    }

    public function callback(Request $req)
    {
        $tapId = $req->query('tap_id');
        $charge = $this->tap->retrieveCharge($tapId);

        // … handle success/failure
    }
}
