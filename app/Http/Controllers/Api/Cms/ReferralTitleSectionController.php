<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Models\ReferralTitleSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReferralTitleSectionController extends Controller
{
    public function storeOrUpdate(Request $request)
    {
        $data = $request->except(['avater_1', 'avater_2', 'avater_3']);

        // Handle avatar uploads
        foreach (['avater_1', 'avater_2', 'avater_3'] as $field) {
            if ($request->hasFile($field)) {
                if ($section = ReferralTitleSection::first()) {
                    $oldImagePath = $section->$field;
                    if ($oldImagePath && Storage::disk('public')->exists(str_replace('storage/', '', $oldImagePath))) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $oldImagePath));
                    }
                }

                $newImagePath = $request->file($field)->store('uploads/referral-avatars', 'public');
                $data[$field] = 'storage/' . $newImagePath;
            }
        }

        $section = ReferralTitleSection::first();

        if ($section) {
            $section->update($data);
        } else {
            $section = ReferralTitleSection::create($data);
        }

        return response()->json([
            'message' => 'Referral Title Section saved successfully.',
            'data' => $section
        ]);
    }

    public function show()
    {
        $data = ReferralTitleSection::first();

        return response()->json([
            'data' => $data
        ]);
    }
}
