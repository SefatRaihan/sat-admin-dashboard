<?php

namespace App\Http\Controllers;

use App\Models\General;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreGeneralRequest;
use App\Http\Requests\UpdateGeneralRequest;

class GeneralController extends Controller
{

    public static $visiblePermissions = [
        'index' => 'List',
        'create' => 'Create Form',
        'store' => 'Save',
        'show' => 'Details',
        'update' => 'Update',
        'destroy' => 'Delete',
        'edit' => 'Edit Form'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $general = General::latest()->first();
        return view('backend.generals.index', compact('general'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.generals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGeneralRequest $request)
    {
        try{

            $request->validate([
                'logo'                  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'favicon_icon'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'title'                 => 'required'
            ]);

            $general = new General();
            $general->uuid = Str::uuid();
            $general->title = $request->title;

            // Handle file uploads and store them in the 'images/general' folder
            if ($request->hasFile('logo')) {
                $general->logo = $request->file('logo')->store('images/general', 'public');;
            }

            if ($request->hasFile('favicon_icon')) {
                $general->favicon_icon = $request->file('favicon_icon')->store('images/general', 'public');
            }

            $general->created_by = Auth::id();

            $general->save();

            return redirect()->route('generals.index')->withMessage('Generals created successfully.');
        }catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(General $general)
    {
        return view('backend.generals.show', compact('general'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(General $general)
    {
        return view('backend.generals.edit', compact('general'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGeneralRequest $request, General $general)
    {
        try{
            $request->validate([
                'logo'                  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'favicon_icon'          => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'title'                 => 'required',
            ]);

            $general->title = $request->title;

            // Handle file uploads and store them in the 'images/general' folder
            if ($request->hasFile('logo')) {
                if ($general->logo) {
                    Storage::delete($general->logo);
                }
                $general->logo = $request->file('logo')->store('images/general', 'public');
            }

            if ($request->hasFile('favicon_icon')) {
                if ($general->favicon_icon) {
                    Storage::delete($general->favicon_icon);
                }
                $general->favicon_icon = $request->file('favicon_icon')->store('images/general', 'public');
            }

            $general->updated_by = Auth::id();

            $general->save();

            return redirect()->route('generals.index')->withMessage('Generals updated successfully.');
        }catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(General $general)
    {
        $general->update(['deleted_by' => Auth::id()]);
        $general->delete();

        return redirect()->route('generals.index')->withMessage('General deleted successfully.');
    }
}
