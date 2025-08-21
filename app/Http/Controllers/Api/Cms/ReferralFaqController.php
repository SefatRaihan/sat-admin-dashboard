<?php

namespace App\Http\Controllers\Api\Cms;

use App\Models\ReferralFaq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralFaqController extends Controller
{
    public function index()
    {
        return response()->json(
            ReferralFaq::with('items')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_subtitle' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'items' => 'required|array',
            'items.*.question' => 'required|string',
            'items.*.answer' => 'required|string',
            'items.*.status' => 'boolean',
        ]);

        $faqItems = $validated['items'];
        unset($validated['items']);

        DB::transaction(function () use ($validated, $faqItems, &$faq) {
            // Only one Referral FAQ row allowed
            $faq = ReferralFaq::first();

            if ($faq) {
                $faq->update($validated);
                $faq->items()->delete();
            } else {
                $faq = ReferralFaq::create($validated);
            }

            foreach ($faqItems as $item) {
                $faq->items()->create($item);
            }
        });

        return response()->json([
            'message' => 'Referral FAQ and items saved successfully',
            'data' => $faq->load('items')
        ], 200);
    }

    public function show(ReferralFaq $referralFaq)
    {
        return response()->json($referralFaq->load('items'));
    }

    public function update(Request $request, ReferralFaq $referralFaq)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string|url',
        ]);

        $referralFaq->update($data);

        return response()->json($referralFaq);
    }

    public function destroy(ReferralFaq $referralFaq)
    {
        $referralFaq->delete();

        return response()->json(['message' => 'Referral FAQ deleted']);
    }
}