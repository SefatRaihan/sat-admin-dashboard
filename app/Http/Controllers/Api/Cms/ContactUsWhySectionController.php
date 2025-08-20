<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Models\ContactUsWhySection;
use Illuminate\Http\Request;

class ContactUsWhySectionController extends Controller
{
    // 1. Get method
    public function show()
    {
        $section = ContactUsWhySection::first();
        return response()->json($section, 200);
    }

    // 2. Create/Update method
    public function storeOrUpdate(Request $request)
    {
        $section = ContactUsWhySection::first();

        if (!$section) {
            // Create if no record exists
            $section = ContactUsWhySection::create($request->all());
        } else {
            // Update if already exists
            $section->update($request->all());
        }

        return response()->json([
            'message' => 'Data saved successfully',
            'data' => $section
        ], 200);
    }
}
