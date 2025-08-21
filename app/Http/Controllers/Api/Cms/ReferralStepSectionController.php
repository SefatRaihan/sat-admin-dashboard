<?php

namespace App\Http\Controllers\Api\Cms;

use App\Models\ReferralStepSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReferralStepSectionController extends Controller
{
    public function index()
    {
        return response()->json(
            ReferralStepSection::with('items')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'items' => 'required|array',
            'items.*.icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'items.*.image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'items.*.alt_text' => 'nullable|string',
            'items.*.title' => 'required|string',
            'items.*.description' => 'required|string',
            'items.*.status' => 'boolean',
        ]);

        $items = $validated['items'];
        unset($validated['items']);

        DB::transaction(function () use ($validated, $items, &$section) {
            $section = ReferralStepSection::first();

            if ($section) {
                $section->update($validated);
                $section->items()->delete();
            } else {
                $section = ReferralStepSection::create($validated);
            }

            foreach ($items as $item) {
                // Handle image
                if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $item['image']->store('referral-step-section', 'public');
                    $item['image'] = $path;
                }

                // Handle icon
                if (isset($item['icon']) && $item['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $item['icon']->store('referral-step-section', 'public');
                    $item['icon'] = $path;
                }

                $section->items()->create($item);
            }
        });

        return response()->json([
            'message' => 'Referral Step Section and items saved successfully',
            'data' => $section->load('items')
        ], 200);
    }

    public function show(ReferralStepSection $referralStepSection)
    {
        return response()->json($referralStepSection->load('items'));
    }

    public function update(Request $request, ReferralStepSection $referralStepSection)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
        ]);

        $referralStepSection->update($data);
        return response()->json($referralStepSection);
    }

    public function destroy(ReferralStepSection $referralStepSection)
    {
        // Delete associated images and icons
        foreach ($referralStepSection->items as $item) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            if ($item->icon && Storage::disk('public')->exists($item->icon)) {
                Storage::disk('public')->delete($item->icon);
            }
        }

        $referralStepSection->delete();
        return response()->json(['message' => 'Referral Step Section deleted']);
    }
}