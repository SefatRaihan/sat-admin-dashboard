<?php

namespace App\Http\Controllers\Api;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use FFMpeg\FFMpeg;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $query = Lesson::query();

        if ($request->has('search') && $request->search) {
            $query->where('file_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status !== 'All') {
            $state = $request->status === 'Active only' ? 1 : 0;
            $query->where('state', $state);
        }

        if ($request->has('audience') && !empty($request->audience)) {
            $query->whereIn('audience', $request->audience);
        }

        if ($request->has('question_type') && !empty($request->question_type)) {
            $query->whereIn('question_type', $request->question_type);
        }

        if ($request->has('crated_start_at') && $request->crated_start_at) {
            $query->whereDate('created_at', '>=', $request->crated_start_at);
        }

        if ($request->has('crated_end_at') && $request->crated_end_at) {
            $query->whereDate('created_at', '<=', $request->crated_end_at);
        }

        $perPage = $request->input('per_page', 10);
        $lessons = $query->paginate($perPage);

        return response()->json([
            'data' => $lessons->items(),
            'total' => $lessons->total(),
            'per_page' => $lessons->perPage(),
            'current_page' => $lessons->currentPage(),
            'last_page' => $lessons->lastPage(),
            'from' => $lessons->firstItem(),
            'to' => $lessons->lastItem()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'audience' => 'required|in:High School,Graduation,College,SAT 2',
            'question_type' => 'nullable|in:Verbal,Quant,Physics,Chemistry,Biology,Math',
            'file' => 'required|file|mimes:jpeg,png,pdf,gif,mp3,mp4|max:358400',
            'file_name' => 'required|string',
            'file_type' => 'required|in:Video,PDF,Image,Audio',
            'file_size' => 'required|numeric',
            'total_length' => 'nullable|string'
        ]);

        $file = $request->file('file');
        $path = $file->store('lessons', 'public'); // Change to 's3' for S3 storage

        $lesson = Lesson::create([
            'uuid' => Str::uuid(),
            'audience' => $request->audience,
            'question_type' => $request->question_type,
            'file_name' => $request->file_name,
            'file_type' => $request->file_type,
            'file_size' => $request->file_size,
            'file_path' => $path, // Use Storage::disk('s3')->url($path) for S3
            'total_length' => $request->file_type === 'Video' ? $this->getVideoLength($file) : null,
            'state' => true,
            'created_by' => auth()->id()
        ]);

        return response()->json(['success' => true, 'lesson' => $lesson], 200);
    }

    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return response()->json($lesson);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'audience' => 'required|in:High School,Graduation,College,SAT 2',
            'question_type' => 'nullable|in:Verbal,Quant,Physics,Chemistry,Biology,Math'
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'audience' => $request->audience,
            'question_type' => $request->question_type,
            'updated_by' => auth()->id()
        ]);

        return response()->json(['success' => true, 'lesson' => $lesson], 200);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'lessons' => 'required|array',
            'lessons.*' => 'exists:lessons,uuid'
        ]);

        Lesson::whereIn('uuid', $request->lessons)->update([
            'deleted_by' => auth()->id(),
            'deleted_at' => now()
        ]);

        return response()->json(['success' => true]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'state' => 'required|in:active,inactive'
        ]);

        $lesson = Lesson::findOrFail($id);
        $lesson->update([
            'state' => $request->state === 'active',
            'updated_by' => auth()->id()
        ]);

        return response()->json(['success' => true]);
    }

    private function getVideoLength($file)
    {
        try {
            $ffmpeg = FFMpeg::create();
            $video = $ffmpeg->open($file->getPathname());
            $duration = $video->getDurationInSeconds();
            $minutes = floor($duration / 60);
            $seconds = $duration % 60;
            return sprintf('%02d:%02d', $minutes, $seconds);
        } catch (\Exception $e) {
            \Log::error('Failed to get video length: ' . $e->getMessage());
            return '00:00'; // Fallback
        }
    }
}
