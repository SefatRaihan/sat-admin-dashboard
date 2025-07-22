<?php

namespace App\Http\Controllers\Api;

use FFMpeg\FFProbe;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $query = Lesson::query();

        if ($request->has('search') && $request->search) {
            $query->where('file_name', 'like', '%' . $request->search . '%')
                  ->orWhere('title', 'like', '%' . $request->search . '%');
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

    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,pdf,gif,mp3,mp4|max:358400'
        ]);

        $file = $request->file('file');
        $path = $file->store('lessons', 'public'); // Change to 's3' for S3 storage
        $totalLength = $file->getClientOriginalExtension() == 'mp4' ? $this->getVideoLength($file) : null;

        return response()->json([
            'success' => true,
            'file_path' => $path,
            'total_length' => $totalLength
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'audience' => 'required|in:High School,Graduation,College,SAT 2',
            'question_type' => 'nullable|in:Verbal,Quant,Physics,Chemistry,Biology,Math',
            'files' => 'required|array',
            'files.*.file_name' => 'required|string',
            'files.*.file_type' => 'required|in:Video,PDF,Image,Audio',
            'files.*.file_size' => 'required|numeric',
            'files.*.file_path' => 'required|string',
            'files.*.total_length' => 'nullable|string',
            'files.*.title' => 'nullable|string',
            'files.*.description' => 'nullable|string'
        ]);

        $lessons = [];
        foreach ($request['files'] as $fileData) {
            $lesson = Lesson::create([
                'uuid' => Str::uuid(),
                'audience' => $request->audience,
                'question_type' => $request->question_type,
                'file_name' => $fileData['file_name'],
                'file_type' => $fileData['file_type'],
                'file_size' => $fileData['file_size'],
                'file_path' => $fileData['file_path'],
                'total_length' => $fileData['total_length'] ?? null,
                'title' => $fileData['title'] ?? null,
                'description' => $fileData['description'] ?? null,
                'state' => true,
                'created_by' => auth()->id()
            ]);
            $lessons[] = $lesson;
        }


        return response()->json(['success' => true, 'lessons' => $lessons], 200);
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
            'question_type' => 'nullable|in:Verbal,Quant,Physics,Chemistry,Biology,Math',
            'files' => 'required|array',
            'files.*.file_name' => 'required|string',
            'files.*.file_type' => 'required|in:Video,PDF,Image,Audio',
            'files.*.file_size' => 'required|numeric',
            'files.*.file_path' => 'required|string',
            'files.*.total_length' => 'nullable|string',
            'files.*.title' => 'nullable|string',
            'files.*.description' => 'nullable|string'
        ]);

        $lesson = Lesson::findOrFail($id);
        $fileData = $request['files'][0]; // Assuming single file for update
        $lesson->update([
            'audience' => $request->audience,
            'question_type' => $request->question_type,
            'file_name' => $fileData['file_name'],
            'file_type' => $fileData['file_type'],
            'file_size' => $fileData['file_size'],
            'file_path' => $fileData['file_path'],
            'total_length' => $fileData['total_length'] ?? null,
            'title' => $fileData['title'] ?? null,
            'description' => $fileData['description'] ?? null,
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
            $getID3 = new \getID3;
            $path = $file->getRealPath();

            if (!file_exists($path)) {
                \Log::error("File does not exist at path: $path");
                return '00:00';
            }

            $info = $getID3->analyze($path);
            if (!isset($info['playtime_seconds'])) {
                \Log::error("Unable to get playtime from getID3.");
                return '00:00';
            }

            $duration = (int) $info['playtime_seconds'];
            return gmdate("H:i:s", $duration);
        } catch (\Exception $e) {
            \Log::error('Failed to get video length (getID3): ' . $e->getMessage());
            return '00:00';
        }
    }

}