<?php

namespace App\Http\Controllers\Api;

use App\Models\FaqItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\FaqItemResource;

class FaqItemController extends Controller
{
    public function index()
    {
        return FaqItemResource::collection(FaqItem::latest()->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'faq_id' => 'required|exists:faqs,id',
            'question' => 'required|string',
            'answer' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        $faqItem = FaqItem::create($data);
        return new FaqItemResource($faqItem);
    }

    public function show(FaqItem $faqItem)
    {
        return new FaqItemResource($faqItem);
    }

    public function update(Request $request, FaqItem $faqItem)
    {
        $data = $request->validate([
            'faq_id' => 'required|exists:faqs,id',
            'question' => 'required|string',
            'answer' => 'required|string',
            'status' => 'nullable|boolean',
        ]);

        $faqItem->update($data);
        return new FaqItemResource($faqItem);
    }

    public function destroy(FaqItem $faqItem)
    {
        $faqItem->delete();
        return response()->json(['message' => 'FAQ Item deleted']);
    }
}
