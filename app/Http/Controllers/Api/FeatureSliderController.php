<?php

namespace App\Http\Controllers\Api;

use App\Models\FeatureSlider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FeatureSliderResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FeatureSliderController extends Controller
{
    public function index()
    {
        return FeatureSliderResource::collection(FeatureSlider::with('items')->latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string|url',
            'slider_items' => 'nullable|array',
            'slider_items.*.image' => 'nullable|file|image|max:2048',
            'slider_items.*.title' => 'nullable|string',
            'slider_items.*.description' => 'nullable|string',
        ]);
    
        $sliderItems = $request->file('slider_items') ?? [];
        // dd($sliderItems);
        unset($validated['slider_items']);
    
        DB::transaction(function () use ($request, $validated, $sliderItems, &$slider) {
            $slider = FeatureSlider::first();
    
            if ($slider) {
                // Delete old images
                foreach ($slider->items as $oldItem) {
                    if ($oldItem->image && Storage::exists($oldItem->image)) {
                        Storage::delete($oldItem->image);
                    }
                }
    
                $slider->update($validated);
                $slider->items()->delete();
            } else {
                $slider = FeatureSlider::create($validated);
            }
    
            // Save new items if any
            foreach ($sliderItems as $index => $fileGroup) {
                // Skip if no image is uploaded
                if (!isset($fileGroup['image'])) continue;
    
                $imagePath = 'storage/' . $fileGroup['image']->store('feature_slider_images', 'public');

    
                $slider->items()->create([
                    'image' => $imagePath,
                    'title' => $request->input("slider_items.$index.title"),
                    'description' => $request->input("slider_items.$index.description"),
                ]);
            }
        });
    
        return response()->json([
            'message' => 'Feature Slider and items saved successfully',
            'data' => $slider->load('items')
        ]);
    }

    public function show(FeatureSlider $feature_slider)
    {
        return new FeatureSliderResource($feature_slider->load('items'));
    }

    public function update(Request $request, FeatureSlider $feature_slider)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string|url',
        ]);

        $feature_slider->update($data);
        return new FeatureSliderResource($feature_slider);
    }

    public function destroy(FeatureSlider $feature_slider)
    {
        $feature_slider->delete();
        return response()->json(['message' => 'Feature Slider deleted']);
    }
}