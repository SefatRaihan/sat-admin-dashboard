<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use League\Csv\Writer;
use Illuminate\Support\Facades\Response;

class DiscountController extends Controller
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
        return view('backend.discounts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form input
        $validator = Validator::make($request->all(), [
            'discount_code' => 'required|string|unique:discounts,discount_code|max:255',
            'discount_amount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:Percentage,Fixed',
            'maximum_no_of_user' => 'required|integer|min:1',
            'expiry_date' => 'required|date|after_or_equal:today',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        try {
            // Create a new Discount record
            Discount::create([
                'discount_code' => $request->discount_code,
                'discount_amount' => $request->discount_amount,
                'discount_type' => $request->discount_type,
                'maximum_no_of_user' => $request->maximum_no_of_user,
                'expiry_date' => $request->expiry_date,
            ]);

            // Redirect with success message
            return redirect()->route('discounts.index') // Adjust to your index route
                             ->with('success', 'Coupon code created successfully!');
        } catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /*
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        return view('backend.discounts.show', compact('discount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('backend.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {

        $validator = Validator::make($request->all(), [
            'discount_code' => 'required|string|max:255|unique:discounts,discount_code,' . $discount->id,
            'discount_amount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:Percentage,Fixed',
            'maximum_no_of_user' => 'required|integer|min:1',
            'expiry_date' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $discount->update($request->only([
                'discount_code',
                'discount_amount',
                'discount_type',
                'maximum_no_of_user',
                'expiry_date',
            ]));

            // Redirect with success message
            return redirect()->route('discounts.index') // Adjust to your index route
                             ->with('success', 'Coupon code updated successfully!');
        } catch(QueryException $e){
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        //
    }

    public function getDiscounts(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $page = $request->query('page', 1);
        $search = $request->query('search', '');
        $sort = $request->query('sort', 'Latest');

        $query = Discount::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('discount_code', 'like', "%{$search}%")
                  ->orWhere('discount_type', 'like', "%{$search}%")
                  ->orWhere('discount_amount', 'like', "%{$search}%");
            });
        }

        if ($sort === 'Latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'Oldest') {
            $query->orderBy('created_at', 'asc');
        }

        $discounts = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $discounts,
        ]);
    }

    public function exportCsv(Request $request)
    {
        $search = $request->query('search', '');
        $sort = $request->query('sort', 'Latest');

        $query = Discount::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('discount_code', 'like', "%{$search}%")
                  ->orWhere('discount_type', 'like', "%{$search}%")
                  ->orWhere('discount_amount', 'like', "%{$search}%");
            });
        }

        if ($sort === 'Latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'Oldest') {
            $query->orderBy('created_at', 'asc');
        }

        $discounts = $query->get();

        $csv = Writer::createFromString();
        $csv->insertOne([
            'ID',
            'Discount Code',
            'Discount Type',
            'Discount Amount',
            'Expiry Date',
            'Max Uses',
            'No. Redeemed',
            'Created At',
        ]);

        foreach ($discounts as $discount) {
            $csv->insertOne([
                $discount->id,
                $discount->discount_code,
                $discount->discount_type,
                $discount->discount_amount,
                $discount->expiry_date,
                $discount->maximum_no_of_user,
                $discount->no_redeemed ?? 0,
                $discount->created_at,
            ]);
        }

        $filename = 'discounts_' . now()->format('Ymd_His') . '.csv';

        return Response::make($csv->toString(), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
