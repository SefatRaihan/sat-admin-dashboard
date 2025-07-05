<?php

namespace App\Http\Controllers\Api;

use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    public function index(Request $request)
    {
        $query = Chapter::query();

        // Search
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        // Filters
        if ($request->has('created_start_at') && $request->created_start_at) {
            $query->whereDate('created_at', '>=', $request->created_start_at);
        }

        if ($request->has('created_end_at') && $request->created_end_at) {
            $query->whereDate('created_at', '<=', $request->created_end_at);
        }

        if ($request->has('status') && $request->status !== 'All') {
            $state = $request->status === 'Active' ? 1 : 0;
            $query->where('state', $state);
        }

        if ($request->has('audience') && !empty($request->audience)) {
            $query->whereIn('audience', $request->audience);
        }

        if ($request->has('subject') && !empty($request->subject)) {
            $query->whereIn('type', $request->subject);
        }

        $perPage = $request->input('per_page', 10);
        $chapters = $query->latest()->paginate($perPage);

        return response()->json($chapters);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'audience' => 'required|string|in:High School,Graduation,College,SAT 2',
            'type' => 'required|string|in:Verbal,Quant,Physics,Chemistry,Biology,Math',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'errors' => $validator->errors()], 422);
        }

        $chapter = Chapter::create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'description' => $request->description,
            'audience' => $request->audience,
            'type' => $request->type,
            'state' => true,
            'created_by' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'data' => $chapter], 201);
    }

    public function show($id)
    {
        $chapter = Chapter::findOrFail($id);
        return response()->json($chapter);
    }

    public function update(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'audience' => 'required|string|in:High School,Graduation,College,SAT 2',
            'type' => 'required|string|in:Verbal,Quant,Physics,Chemistry,Biology,Math',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first(), 'errors' => $validator->errors()], 422);
        }

        $chapter->update([
            'title' => $request->title,
            'description' => $request->description,
            'audience' => $request->audience,
            'type' => $request->type,
            'updated_by' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'data' => $chapter]);
    }

    public function updateState(Request $request, $id)
    {
        $chapter = Chapter::findOrFail($id);
        $chapter->update([
            'state' => $request->state,
            'updated_by' => Auth::id(),
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'uuids' => 'required|array',
            'uuids.*' => 'exists:chapters,uuid',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        Chapter::whereIn('uuid', $request->uuids)->update([
            'deleted_by' => Auth::id(),
            'deleted_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }
}
