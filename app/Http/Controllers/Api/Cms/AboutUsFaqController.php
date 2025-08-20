<?php

namespace App\Http\Controllers\Api\Cms;

use App\Models\AboutUsFaq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FaqResource;
use Illuminate\Support\Facades\DB;

class AboutUsFaqController extends Controller
{
    public function index()
    {
        return response()->json(
            AboutUsFaq::with('items')->latest()->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'items' => 'required|array',
            'items.*.question' => 'required|string',
            'items.*.answer' => 'required|string',
            'items.*.status' => 'boolean',
        ]);

        $faqItems = $validated['items'];
        unset($validated['items']);

        DB::transaction(function () use ($validated, $faqItems, &$faq) {
            // Only one About Us FAQ row allowed
            $faq = AboutUsFaq::first();

            if ($faq) {
                $faq->update($validated);
                // Remove old items
                $faq->items()->delete();
            } else {
                $faq = AboutUsFaq::create($validated);
            }

            // Create new items
            foreach ($faqItems as $item) {
                $faq->items()->create($item);
            }
        });

        return response()->json([
            'message' => 'About Us FAQ and items saved successfully',
            'data' => $faq->load('items')
        ], 200);
    }

    public function show(AboutUsFaq $aboutUsFaq)
    {
        return response()->json($aboutUsFaq->load('items'));
    }

    public function update(Request $request, AboutUsFaq $aboutUsFaq)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string|url',
        ]);

        $aboutUsFaq->update($data);
        return response()->json($aboutUsFaq);
    }

    public function destroy(AboutUsFaq $aboutUsFaq)
    {
        $aboutUsFaq->delete();
        return response()->json(['message' => 'About Us FAQ deleted']);
    }
}