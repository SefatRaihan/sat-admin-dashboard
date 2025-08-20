<?php

namespace App\Http\Controllers\Api\Cms;

use App\Models\AboutUsWhySection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FaqResource;
use Illuminate\Support\Facades\DB;

class AboutUsWhySectionController extends Controller
{
    public function index()
    {
        return response()->json(
            AboutUsWhySection::with('items')->latest()->get()
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
            'items.*.title' => 'required|string',
            'items.*.description' => 'required|string',
            'items.*.status' => 'boolean',
        ]);

        $items = $validated['items'];
        unset($validated['items']);

        DB::transaction(function () use ($validated, $items, &$section) {
            // Only one row allowed
            $section = AboutUsWhySection::first();

            if ($section) {
                $section->update($validated);
                // Remove old items
                $section->items()->delete();
            } else {
                $section = AboutUsWhySection::create($validated);
            }

            // Create new items
            foreach ($items as $item) {
                if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $path = $item['image']->store('why-section', 'public');
                    $item['image'] = $path;
                }
                $section->items()->create($item);
            }
        });

        return response()->json([
            'message' => 'About Us Why Section and items saved successfully',
            'data' => $section->load('items')
        ], 200);
    }

    public function show(AboutUsWhySection $aboutUsWhySection)
    {
        return response()->json($aboutUsWhySection->load('items'));
    }

    public function update(Request $request, AboutUsWhySection $aboutUsWhySection)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string|url',
        ]);

        $aboutUsWhySection->update($data);
        return response()->json($aboutUsWhySection);
    }

    public function destroy(AboutUsWhySection $aboutUsWhySection)
    {
        $aboutUsWhySection->delete();
        return response()->json(['message' => 'About Us Why Section deleted']);
    }
}