<?php

namespace App\Http\Controllers\Api;

use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FaqResource;
use Illuminate\Support\Facades\DB;

class FaqController extends Controller
{
    public function index()
    {
        return FaqResource::collection(Faq::with('items')->latest()->get());
    }

    public function store(Request $request)
    {
        dd('f');
        $validated = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string',
            'faq_items' => 'required|array',
            'faq_items.*.question' => 'required|string',
            'faq_items.*.answer' => 'required|string',
            'faq_items.*.status' => 'boolean',
        ]);

        DB::transaction(function () use ($validated, &$faq) {
            $faq = Faq::create($validated);

            foreach ($validated['faq_items'] as $item) {
                $faq->items()->create($item);
            }
        });

        return response()->json([
            'message' => 'FAQ and items created successfully',
            'data' => $faq->load('items')
        ], 201);
    }

    public function show(Faq $faq)
    {
        return new FaqResource($faq->load('items'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string|url',
        ]);

        $faq->update($data);
        return new FaqResource($faq);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return response()->json(['message' => 'FAQ deleted']);
    }
}