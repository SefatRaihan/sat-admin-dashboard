<?php

namespace App\Http\Controllers\Api;

use App\Models\PricingSection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PricingSectionController extends Controller
{
    public function index()
    {
        return PricingSection::with('items')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'items' => 'required|array',
            'items.*.plan_title' => 'required|string',
            'items.*.promotional_badge' => 'nullable|string',
            'items.*.promotional_badge_status' => 'boolean',
            'items.*.description' => 'nullable|string',
            'items.*.pricing' => 'nullable|numeric',
            'items.*.currency' => 'nullable|string',
            'items.*.pricing_terms' => 'nullable|string',
            'items.*.feature_1' => 'nullable|string',
            'items.*.feature_2' => 'nullable|string',
            'items.*.feature_3' => 'nullable|string',
            'items.*.feature_4' => 'nullable|string',
            'items.*.cta_text' => 'nullable|string',
            'items.*.cta_link' => 'nullable|string',
        ]);

        $items = $validated['items'];
        unset($validated['items']);

        DB::transaction(function () use ($validated, $items, &$section) {
            $section = PricingSection::first();

            if ($section) {
                $section->update($validated);
                $section->items()->delete();
            } else {
                $section = PricingSection::create($validated);
            }

            foreach ($items as $item) {
                $section->items()->create($item);
            }
        });

        return response()->json([
            'message' => 'Pricing section saved successfully',
            'data' => $section->load('items')
        ]);
    }
}
