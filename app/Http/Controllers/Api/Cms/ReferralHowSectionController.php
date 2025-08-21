<?php

namespace App\Http\Controllers\Api\Cms;

use App\Models\ReferralHowSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralHowSectionController extends Controller
{
    public function index()
    {
        return response()->json(
            ReferralHowSection::with('items')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'items' => 'required|array',
            'items.*.icon' => 'nullable|string',
            'items.*.title' => 'required|string',
            'items.*.description' => 'required|string',
        ]);

        $items = $validated['items'];
        unset($validated['items']);

        DB::transaction(function () use ($validated, $items, &$section) {
            $section = ReferralHowSection::first();

            if ($section) {
                $section->update($validated);
                $section->items()->delete();
            } else {
                $section = ReferralHowSection::create($validated);
            }

            foreach ($items as $item) {
                $section->items()->create($item);
            }
        });

        return response()->json([
            'message' => 'Referral How Section and items saved successfully',
            'data' => $section->load('items')
        ], 200);
    }

    public function show(ReferralHowSection $referralHowSection)
    {
        return response()->json($referralHowSection->load('items'));
    }

    public function update(Request $request, ReferralHowSection $referralHowSection)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
        ]);

        $referralHowSection->update($data);
        return response()->json($referralHowSection);
    }

    public function destroy(ReferralHowSection $referralHowSection)
    {
        $referralHowSection->delete();
        return response()->json(['message' => 'Referral How Section deleted']);
    }
}