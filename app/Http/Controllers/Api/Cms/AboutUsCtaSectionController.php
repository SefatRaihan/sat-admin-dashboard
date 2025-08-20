<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUsCtaSection;
use Illuminate\Support\Facades\Storage;

class AboutUsCtaSectionController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        // dd($request->all());
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

        $catSection = AboutUsCtaSection::first();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($catSection && $catSection->image && Storage::disk('public')->exists($catSection->image)) {
                Storage::disk('public')->delete($catSection->image);
            }

            // Store new image
            $validated['image'] = 'storage/' . $request->file('image')->store('about-us-cta-section', 'public');
        }

        if ($catSection) {
            $catSection->update($validated);
        } else {
            $catSection = AboutUsCtaSection::create($validated);
        }

        return response()->json([
            'message' => 'Cta section saved successfully',
            'data' => $catSection,
        ], 200);
    }
}
