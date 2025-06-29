<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    
    public function index()
    {
        return view('topics.index');
    }

    public function fetch()
    {
        return response()->json(Topic::all());
    }

    public function create()
    {
        return view('backend.topics.index');
    }


    public function update(Request $request, Topic $topic)
    {
        $topic->update($request->all());
        return response()->json($topic);
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return response()->json(['success' => true]);
    }
}
