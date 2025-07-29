<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CatSection;
use Illuminate\Support\Facades\Storage;

class CatSectionController extends Controller
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

        $catSection = CatSection::first();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($catSection && $catSection->image && Storage::disk('public')->exists($catSection->image)) {
                Storage::disk('public')->delete($catSection->image);
            }

            // Store new image
            $validated['image'] = $request->file('image')->store('cat-section', 'public');
        }

        if ($catSection) {
            $catSection->update($validated);
        } else {
            $catSection = CatSection::create($validated);
        }

        return response()->json([
            'message' => 'Cat section saved successfully',
            'data' => $catSection,
        ], 200);
    }
}
