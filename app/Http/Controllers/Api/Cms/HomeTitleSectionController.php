<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeTitleSection;
use Illuminate\Support\Facades\Storage;

class HomeTitleSectionController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $data = $request->except(['avater_1', 'avater_2', 'avater_3']);
    
        foreach (['avater_1', 'avater_2', 'avater_3'] as $field) {
            if ($request->hasFile($field)) {
                if ($homeTitleSection = HomeTitleSection::first()) {
                    $oldImagePath = $homeTitleSection->$field;
                    if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }

                $newImagePath = $request->file($field)->store('uploads/avatars', 'public');
                $data[$field] = 'storage/' . $newImagePath;
            }
        }

        $homeTitleSection = HomeTitleSection::first();
    
        if ($homeTitleSection) {
            $homeTitleSection->update($data);
        } else {
            $homeTitleSection = HomeTitleSection::create($data);
        }
    
        return response()->json([
            'message' => 'Data saved successfully.',
            'data' => $homeTitleSection
        ]);
    }

    public function show()
    {
        $data = HomeTitleSection::first();

        return response()->json([
            'data' => $data
        ]);
    }
}
