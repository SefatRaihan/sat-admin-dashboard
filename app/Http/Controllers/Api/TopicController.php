<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Start query using Eloquent
            $query = Topic::query();

            // Apply search filter if present
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where('name', 'like', "%{$search}%");
            }

            // Get pagination value or default to 10
            $perPage = $request->get('per_page', 10);
            $topics = $query->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $topics
            ], 200); // 200 OK status code

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve topics: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'topic'          => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        try {
            if ($request->topicId != null) {
                // If questionId is provided, update the existing topic
                $topic = Topic::find($request->topicId);
                if (!$topic) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Topic not found',
                    ], 404);
                }
                $topic->update([
                    'name' => $request->input('topic'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Topic updated successfully',
                    'data' => $topic
                ], 201); // 201 Updated status code
            } else {
                // If questionId is not provided, create a new topic
                $topic = Topic::create([
                    'name' => $request->input('topic'),
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Topic created successfully',
                    'data' => $topic
                ], 201); // 201 Created status code
            }

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create topic: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $topic = Topic::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $topic
            ], 200); // 200 OK status code

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Topic not found: ' . $e->getMessage(),
            ], 404);
        }
    }
     
    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'topic'          => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }


    //     try {
    //         $topic = Topic::find($id)->update([
    //             'name' => $request->input('topic'),
    //         ]);

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Topic updated successfully',
    //             'data' => $topic
    //         ], 201); // 201 Created status code

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to update topic: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function getTopic()
    {
        try {
            $topics = Topic::select('id', 'name as text')->get();
            
            return response()->json([
                'success' => true,
                'data' => $topics
            ], 200); // 200 OK status code

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve topics: ' . $e->getMessage(),
            ], 500);
        }
    }

}
