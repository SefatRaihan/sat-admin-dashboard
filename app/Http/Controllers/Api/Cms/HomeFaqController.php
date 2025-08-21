<?php

namespace App\Http\Controllers\Api\Cms;

use App\Models\HomeFaq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\HomeFaqResource;
use Illuminate\Support\Facades\DB;

class HomeFaqController extends Controller
{
    public function index()
    {
        return HomeFaqResource::collection(HomeFaq::with('items')->latest()->get());
    }

    public function store(Request $request)
    {
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
    
        $faqItems = $validated['faq_items'];
        unset($validated['faq_items']);
    
        DB::transaction(function () use ($validated, $faqItems, &$faq) {
            $faq = HomeFaq::first();
    
            if ($faq) {
                $faq->update($validated);
                $faq->items()->delete();
            } else {
                $faq = HomeFaq::create($validated);
            }
    
            foreach ($faqItems as $item) {
                $faq->items()->create($item);
            }
        });
    
        return response()->json([
            'message' => 'Home FAQ and items saved successfully',
            'data' => $faq->load('items')
        ], 200);
    }

    public function show(HomeFaq $faq)
    {
        return new HomeFaqResource($faq->load('items'));
    }

    public function update(Request $request, HomeFaq $faq)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'cta_subtitle' => 'nullable|string',
            'cta_text' => 'nullable|string',
            'cta_link' => 'nullable|string|url',
        ]);

        $faq->update($data);
        return new HomeFaqResource($faq);
    }

    public function destroy(HomeFaq $faq)
    {
        $faq->delete();
        return response()->json(['message' => 'Home FAQ deleted']);
    }
}