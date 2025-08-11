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
        $request->validate([
            'cards' => 'required|array',
            'cards.*.title' => 'required|string',
            'cards.*.image' => 'nullable|image', // image is optional for update
            'cards.*.description' => 'required|string',
            'cards.*.alt_text' => 'required|string',
            'cards.*.status' => 'nullable|boolean',
            'cards.*.serial' => 'nullable|integer',
            'cards.*.id' => 'nullable|integer|exists:feature_cards,id',
        ]);

        $savedCards = [];

        foreach ($request->cards as $cardData) {

            // If image is uploaded
            if (isset($cardData['image']) && $cardData['image'] instanceof \Illuminate\Http\UploadedFile) {
                $cardData['image'] = 'storage/' . $cardData['image']->store('uploads/feature_cards', 'public');
            } else {
                unset($cardData['image']); // don't overwrite image if not provided
            }

            if (!empty($cardData['id'])) {
                // Update existing card
                $featureCard = FeatureCard::find($cardData['id']);
                $featureCard->update($cardData);
            } else {
                // Create new card
                $featureCard = FeatureCard::create($cardData);
            }

            $savedCards[] = $featureCard;
        }

        return response()->json(FeatureCard::all(), 201);
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
            $data['image'] = 'storage/' . $request->file('image')->store('uploads/feature-cards', 'public');
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
