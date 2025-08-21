<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Models\AboutUsFounderStatement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsFounderStatementController extends Controller
{
    // 1️⃣ GET API - Show data
    public function index()
    {
        $statement = AboutUsFounderStatement::first();
        return response()->json($statement);
    }

    // 2️⃣ CREATE or UPDATE
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'alt_text' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $statement = AboutUsFounderStatement::first();

        // If record doesn't exist, create new
        if (!$statement) {
            $statement = new AboutUsFounderStatement();
        }

        $statement->title = $request->title;
        $statement->subtitle = $request->subtitle;
        $statement->description = $request->description;
        $statement->name = $request->name;
        $statement->location = $request->location;
        $statement->alt_text = $request->alt_text;

        // Handle image
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($statement->image && Storage::disk('public')->exists($statement->image)) {
                Storage::disk('public')->delete($statement->image);
            }

            $path = $request->file('image')->store('about_us/founder_statements', 'public');
            $statement->image = $path;
        }

        $statement->save();

        return response()->json([
            'message' => 'Founder statement saved successfully',
            'data' => $statement,
        ]);
    }
}
