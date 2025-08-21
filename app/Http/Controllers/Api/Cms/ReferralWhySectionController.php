<?php

namespace App\Http\Controllers\Api\Cms;

use App\Models\ReferralWhySection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralWhySectionController extends Controller
{
    public function index()
    {
        return response()->json(
            ReferralWhySection::with('items')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'items' => 'required|array',
            'items.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'items.*.alt_text' => 'nullable|string',
            'items.*.title' => 'required|string',
            'items.*.description' => 'required|string',
            'items.*.status' => 'boolean',
        ]);

        $items = $validated['items'];
        unset($validated['items']);

        DB::transaction(function () use ($validated, $items, &$section) {
            $section = ReferralWhySection::first();

            if ($section) {
                $section->update($validated);
                $section->items()->delete();
            } else {
                $section = ReferralWhySection::create($validated);
            }

            foreach ($items as $item) {
                if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $item['image']->store('referral-why-section', 'public');
                    $item['image'] = $path;
                }
                $section->items()->create($item);
            }
        });

        return response()->json([
            'message' => 'Referral Why Section and items saved successfully',
            'data' => $section->load('items')
        ], 200);
    }

    public function show(ReferralWhySection $referralWhySection)
    {
        return response()->json($referralWhySection->load('items'));
    }

    public function update(Request $request, ReferralWhySection $referralWhySection)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string|url',
        ]);

        $referralWhySection->update($data);
        return response()->json($referralWhySection);
    }

    public function destroy(ReferralWhySection $referralWhySection)
    {
        $referralWhySection->delete();
        return response()->json(['message' => 'Referral Why Section deleted']);
    }
}