<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeCtaSection;
use Illuminate\Support\Facades\Storage;

class HomeCtaSectionController extends Controller
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

        $homeCtaSection = HomeCtaSection::first();

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($homeCtaSection && $homeCtaSection->image && Storage::disk('public')->exists($homeCtaSection->image)) {
                Storage::disk('public')->delete($homeCtaSection->image);
            }

            $validated['image'] = 'storage/' . $request->file('image')->store('home-cta-section', 'public');
        }

        if ($homeCtaSection) {
            $homeCtaSection->update($validated);
        } else {
            $homeCtaSection = HomeCtaSection::create($validated);
        }

        return response()->json([
            'message' => 'Home CTA section saved successfully',
            'data' => $homeCtaSection,
        ], 200);
    }
}