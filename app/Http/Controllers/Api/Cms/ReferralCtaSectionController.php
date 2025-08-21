<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferralCtaSection;
use Illuminate\Support\Facades\Storage;

class ReferralCtaSectionController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'alt_text' => 'nullable|string',
            'info_title' => 'nullable|string',
            'info_subtitle' => 'nullable|string',
            'info_line_1' => 'nullable|string',
            'info_line_2' => 'nullable|string',
            'info_line_3' => 'nullable|string',
            'section_subtitle' => 'nullable|string',
            'section_cta_text' => 'nullable|string',
            'section_cta_link' => 'nullable|string',
            'clutch_review_cta_text' => 'nullable|string',
            'clutch_review_cta_link' => 'nullable|string',
        ]);

        $ctaSection = ReferralCtaSection::first();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($ctaSection && $ctaSection->image && Storage::disk('public')->exists($ctaSection->image)) {
                Storage::disk('public')->delete($ctaSection->image);
            }

            $validated['image'] = 'storage/' . $request->file('image')->store('referral-cta-section', 'public');
        }

        if ($ctaSection) {
            $ctaSection->update($validated);
        } else {
            $ctaSection = ReferralCtaSection::create($validated);
        }

        return response()->json([
            'message' => 'Referral CTA section saved successfully',
            'data' => $ctaSection,
        ], 200);
    }
}