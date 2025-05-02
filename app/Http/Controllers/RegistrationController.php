<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function store(Request $request) 
    {
        try {
            $registration = Registration::create([
                'uuid' => Str::uuid(),
            ] + $request->all());
    
            return response()->json([
                'status' => true,
                'message' => __('Successfully Created'),
                'data' => $registration
            ], 201);
    
        } catch (\Exception | QueryException $e) {
    
            return response()->json([
                'status' => false,
                'error' => config('app.env') == 'production' ? __('Something Went Wrong') : $e->getMessage()
            ], 500);
        }
    }
}
