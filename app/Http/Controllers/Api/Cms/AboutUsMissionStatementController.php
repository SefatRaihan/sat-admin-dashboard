<?php

namespace App\Http\Controllers\Api\Cms;

use App\Http\Controllers\Controller;
use App\Models\AboutUsMissionStatement;
use Illuminate\Http\Request;

class AboutUsMissionStatementController extends Controller
{
    // GET API
    public function show()
    {
        $mission = AboutUsMissionStatement::first();
        return response()->json($mission);
    }

    // STORE/UPDATE API
    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'small_description' => 'required|string',
            'large_description' => 'required|string',
        ]);

        $mission = AboutUsMissionStatement::first();

        if ($mission) {
            $mission->update($request->only(['small_description', 'large_description']));
            return response()->json(['message' => 'Mission updated successfully', 'data' => $mission]);
        } else {
            $mission = AboutUsMissionStatement::create($request->only(['small_description', 'large_description']));
            return response()->json(['message' => 'Mission created successfully', 'data' => $mission]);
        }
    }
}

