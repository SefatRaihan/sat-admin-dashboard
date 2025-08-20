<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUsTitleSection;
use Illuminate\Support\Facades\Storage;

class AboutUsTitleSectionController extends Controller
{

    public function storeOrUpdate(Request $request)
    {
        $data = $request->except(['avater_1', 'avater_2', 'avater_3']);
    
        // Handle avatar uploads
        foreach (['avater_1', 'avater_2', 'avater_3'] as $field) {
            if ($request->hasFile($field)) {
                // Check if old image exists and delete it
                if ($aboutUsTitleSection = AboutUsTitleSection::first()) {
                    $oldImagePath = $aboutUsTitleSection->$field;
                    if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                        // Delete old file
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
    
                // Store the new file and ensure the correct file path with 'storage/'
                $newImagePath = $request->file($field)->store('uploads/avatars', 'public');
                $data[$field] = 'storage/' . $newImagePath;  // Add the 'storage/' prefix to the path

            }
        }
    
        // Fetch the first record (since there should only be one)
        $aboutUsTitleSection = AboutUsTitleSection::first();
    
        if ($aboutUsTitleSection) {
            $aboutUsTitleSection->update($data);
        } else {
            $aboutUsTitleSection = AboutUsTitleSection::create($data);
        }
    
        return response()->json([
            'message' => 'Data saved successfully.',
            'data' => $aboutUsTitleSection
        ]);
    }
    


    public function show()
    {
        $data = AboutUsTitleSection::first();

        return response()->json([
            'data' => $data
        ]);
    }
}
