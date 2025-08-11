<?php

namespace App\Http\Controllers\Api;

use App\Models\MixedSection;
use App\Models\MixedSectionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MixedSectionController extends Controller
{
    // Store or update multiple mixed sections
    public function storeOrUpdateMultipleMixedSections(Request $request)
    {
        $validated = $request->validate([
            'mixed_sections' => 'required|array',
            'mixed_sections.*.id' => 'nullable',
            'mixed_sections.*.title' => 'nullable|string',
            'mixed_sections.*.tab_badge_label' => 'nullable|string',
            'mixed_sections.*.subtitle' => 'nullable|string',
            'mixed_sections.*.status' => 'nullable|boolean',
            'mixed_sections.*.image' => 'nullable|file|image|max:2048',
            'mixed_sections.*.bullet_point_1' => 'nullable|string',
            'mixed_sections.*.bullet_point_2' => 'nullable|string',
            'mixed_sections.*.bullet_point_3' => 'nullable|string',
            'mixed_sections.*.mixed_section_items' => 'nullable|array',
            'mixed_sections.*.mixed_section_items.*.image' => 'nullable|file|image|max:2048',
            'mixed_sections.*.mixed_section_items.*.title' => 'nullable|string',
            'mixed_sections.*.mixed_section_items.*.description' => 'nullable|string',
            'mixed_sections.*.mixed_section_items.*.id' => 'nullable',
        ]);
    
        $savedSections = [];
    
        DB::transaction(function () use ($validated, $request, &$savedSections) {
            foreach ($validated['mixed_sections'] as $index => $sectionData) {
                $mixedSection = MixedSection::updateOrCreate(
                    ['id' => $sectionData['id'] ?? null],
                    [
                        'title' => $sectionData['title'] ?? null,
                        'tab_badge_label' => $sectionData['tab_badge_label'] ?? null,
                        'subtitle' => $sectionData['subtitle'] ?? null,
                        'status' => $sectionData['status'] ?? null,
                        'bullet_point_1' => $sectionData['bullet_point_1'] ?? null,
                        'bullet_point_2' => $sectionData['bullet_point_2'] ?? null,
                        'bullet_point_3' => $sectionData['bullet_point_3'] ?? null,
                    ]
                );
    
                if (isset($sectionData['image']) && $request->hasFile("mixed_sections.{$index}.image")) {
                    if ($mixedSection->image && Storage::exists($mixedSection->image)) {
                        Storage::delete($mixedSection->image);
                    }
                    $mixedSection->image = 'storage/' . $request->file("mixed_sections.{$index}.image")->store('mixed_section_images', 'public');
                    $mixedSection->save();
                }
    
                if (isset($sectionData['mixed_section_items']) && is_array($sectionData['mixed_section_items'])) {
                    foreach ($sectionData['mixed_section_items'] as $itemIndex => $itemData) {
                        if (isset($itemData['image']) && $request->hasFile("mixed_sections.{$index}.mixed_section_items.{$itemIndex}.image")) {
                            $existingItem = MixedSectionItem::find($itemData['id'] ?? null);
                            if ($existingItem && $existingItem->image && Storage::exists($existingItem->image)) {
                                Storage::delete($existingItem->image);
                            }
                            $itemData['image'] = 'storage/' . $request->file("mixed_sections.{$index}.mixed_section_items.{$itemIndex}.image")->store('mixed_section_item_images', 'public');
                        }
    
                        $mixedSection->items()->updateOrCreate(
                            ['id' => $itemData['id'] ?? null],
                            $itemData
                        );
                    }
                }
    
                // Reload with items after save
                $savedSections[] = $mixedSection->load('items');
            }
        });
    
        return response()->json([
            'message' => 'Multiple Mixed Sections created/updated successfully',
            'data' => $savedSections,
        ]);
    }

    // Fetch all mixed sections with items
    public function getAllMixedSections()
    {
        $mixedSections = MixedSection::with('items')->get();

        return response()->json([
            'message' => 'Fetched all mixed sections successfully',
            'data' => $mixedSections,
        ]);
    }
}
