<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TitleSection;
use Illuminate\Support\Facades\Storage;

class TitleSectionController extends Controller
{

    public function storeOrUpdate(Request $request)
    {
        $data = $request->except(['avater_1', 'avater_2', 'avater_3']);
    
        // Handle avatar uploads
        foreach (['avater_1', 'avater_2', 'avater_3'] as $field) {
            if ($request->hasFile($field)) {
                // Check if old image exists and delete it
                if ($titleSection = TitleSection::first()) {
                    $oldImagePath = $titleSection->$field;
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
        $titleSection = TitleSection::first();
    
        if ($titleSection) {
            $titleSection->update($data);
        } else {
            $titleSection = TitleSection::create($data);
        }
    
        return response()->json([
            'message' => 'Data saved successfully.',
            'data' => $titleSection
        ]);
    }
    


    public function show()
    {
        $data = TitleSection::first();

        return response()->json([
            'data' => $data
        ]);
    }
}
