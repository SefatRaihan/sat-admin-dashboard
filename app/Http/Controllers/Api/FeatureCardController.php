<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeatureCard;
use App\Http\Resources\FeatureCardResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureCardController extends Controller
{
    // Get all feature cards
    public function index()
    {
        $featureCards = FeatureCard::all(); // You can use pagination: ->paginate(10)
        return FeatureCardResource::collection($featureCards);
    }

    // Get a single feature card
    public function show($id)
    {
        $featureCard = FeatureCard::findOrFail($id);  // Throws 404 if not found
        return new FeatureCardResource($featureCard);
    }

    // Create a new feature card
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image', // Ensure that the uploaded file is an image
            'description' => 'required|string',
            'alt_text' => 'required|string',
            'status' => 'nullable|boolean',
            'serial' => 'nullable|integer',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Store the image in 'public/uploads/feature_cards'
            $imagePath = $request->file('image')->store('uploads/feature_cards', 'public');
        }

        // Create the feature card with the uploaded image path
        $featureCard = FeatureCard::create([
            'title' => $request->input('title'),
            'image' => $imagePath ?? null,  // Save the image path if the image was uploaded
            'description' => $request->input('description'),
            'alt_text' => $request->input('alt_text'),
            'status' => $request->input('status', true), // Default to true if not provided
            'serial' => $request->input('serial'),
        ]);

        // Return the created feature card with a successful response
        return response()->json(new FeatureCardResource($featureCard), 201);
    }

    // Update an existing feature card
    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable|file|image|max:2048', // image is now optional file upload
            'description' => 'required|string',
            'alt_text' => 'required|string',
            'status' => 'nullable|boolean',
            'serial' => 'nullable|integer',
        ]);

        $featureCard = FeatureCard::findOrFail($id);

        $data = $request->except('image');

        // If new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($featureCard->image && \Storage::disk('public')->exists($featureCard->image)) {
                \Storage::disk('public')->delete($featureCard->image);
            }

            // Save new image
            $data['image'] = $request->file('image')->store('uploads/feature-cards', 'public');
        }

        $featureCard->update($data);

        return response()->json(new FeatureCardResource($featureCard));
    }

    // Delete a feature card
    public function destroy($id)
    {
        $featureCard = FeatureCard::findOrFail($id); // Throws 404 if not found
        $featureCard->delete();

        return response()->json(['message' => 'Feature card deleted successfully']);
    }
}
