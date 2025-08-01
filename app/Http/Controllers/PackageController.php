<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
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
        $allPackages = Package::get();
        $highSchools = Package::where('audience', 'High School')->get();
        $colleges = Package::where('audience', 'College')->get();
        $graduates = Package::where('audience', 'Graduate')->get();
        $sat2 = Package::where('package_type', 'SAT 2')->get();

        return view('backend.packages.index', compact('allPackages', 'highSchools', 'colleges', 'graduates', 'sat2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Define validation rules
            $rules = [
                'packageType' => 'required|in:SAT 1,SAT 2',
                'packageStatus' => 'required|in:Active,Inactive',
                'planTitle' => 'required|string|max:255',
                'description' => 'nullable|string',
                'promotionalBadge' => 'nullable|string|max:255',
                'pricing' => 'required|numeric|min:0',
                'pricingTerms' => 'nullable|string|max:255',
                'pricingTermRadio' => 'required|in:Yearly,Monthly,3-Month,6-Month,Other',
                'other_description' => 'nullable|string|required_if:pricingTermRadio,Other',
                'validity' => 'nullable|string|max:255',
            ];

            // Conditionally add audience validation if packageType is SAT 1
            if ($request->packageType === 'SAT 1') {
                $rules['audience'] = 'required|in:High School,College,Graduate';
            }

            // Validate the request
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Map form data to database fields
            $data = [
                'package_type' => $request->packageType,
                'audience' => $request->packageType === 'SAT 1' ? $request->audience : null,
                'status' => $request->packageStatus === 'Active' ? 1 : 0,
                'highlight_status' => $request->has('highlight') ? 1 : 0,
                'title' => $request->planTitle,
                'description' => $request->description,
                'promotional_badge' => $request->promotionalBadge ? floatval(str_replace('%', '', $request->promotionalBadge)) : 0.00,
                'highlight_badge' => $request->has('highlight_badge') ? 1 : 0,
                'price' => $request->pricing,
                'pricing_terms' => strtolower(str_replace('-', '', $request->pricingTermRadio)), // Convert to match enum (e.g., '3-Month' -> '3month')
                'terms_per_month' => $request->pricingTerms,
                'other_description' => $request->other_description,
                'validity' => $request->validity,
                'activated_at' => $request->packageStatus === 'Active' ? now() : null,
            ];

            // Calculate duration_days based on validity or pricingTermRadio
            $data['duration_days'] = $this->calculateDurationDays($request->pricingTermRadio, $request->validity);

            // Create the package
            Package::create($data);

            return redirect()->route('packages.index')->withMessage('Package added successfully!)');
        } catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    // Helper method to calculate duration_days
    private function calculateDurationDays($pricingTerm, $validity)
    {
        if ($pricingTerm === 'Yearly') {
            return 365;
        } elseif ($pricingTerm === 'Monthly') {
            return 30;
        } elseif ($pricingTerm === '3-Month') {
            return 90;
        } elseif ($pricingTerm === '6-Month') {
            return 180;
        } elseif ($pricingTerm === 'Other' && $validity) {
            // Extract number from validity (e.g., "6 Months" -> 6)
            preg_match('/\d+/', $validity, $matches);
            return !empty($matches) ? (int)$matches[0] * 30 : 0;
        }
        return 0;
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('backend.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        try{
            $rules = [
                'packageType' => 'required|in:SAT 1,SAT 2',
                'packageStatus' => 'required|in:Active,Inactive',
                'planTitle' => 'required|string|max:255',
                'description' => 'nullable|string',
                'promotionalBadge' => 'nullable|string|max:255',
                'pricing' => 'required|numeric|min:0',
                'pricingTerms' => 'nullable|string|max:255',
                'pricingTermRadio' => 'required|in:Yearly,Monthly,3-Month,6-Month,Other',
                'other_description' => 'nullable|string|required_if:pricingTermRadio,Other',
                'validity' => 'nullable|string|max:255',
            ];

            if ($request->packageType === 'SAT 1') {
                $rules['audience'] = 'required|in:High School,College,Graduate';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                'package_type' => $request->packageType,
                'audience' => $request->packageType === 'SAT 1' ? $request->audience : null,
                'status' => $request->packageStatus === 'Active' ? 1 : 0,
                'highlight_status' => $request->has('highlight') ? 1 : 0,
                'title' => $request->planTitle,
                'description' => $request->description,
                'promotional_badge' => $request->promotionalBadge ? floatval(str_replace('%', '', $request->promotionalBadge)) : 0.00,
                'highlight_badge' => $request->has('highlight_badge') ? 1 : 0,
                'price' => $request->pricing,
                'pricing_terms' => strtolower(str_replace('-', '', $request->pricingTermRadio)),
                'terms_per_month' => $request->pricingTerms,
                'other_description' => $request->other_description,
                'validity' => $request->validity,
                'activated_at' => $request->packageStatus === 'Active' ? now() : null,
            ];

            $data['duration_days'] = $this->calculateDurationDays($request->pricingTermRadio, $request->validity);

            $package->update($data);

            return redirect()->route('packages.index')->with('success', 'Package updated successfully!');
        } catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        //
    }
}
