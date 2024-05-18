<?php

namespace App\Http\Controllers;

use App\Models\coffee;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\shippingPartners;


class CoffeeController extends Controller
{
    public function index()
    {
        $listingData['data'] = coffee::all();

        return view('coffee_sales', $listingData);
    }
    public function create()
    {
        return view('coffee_sales_add');
    }
    public function calculatePrice(Request $request)
    {
        // Return the calculated values
        try {
            // Validate the input data

            $validator = validator::make($request->all(), [
                'quantity' => 'required|integer|min:1',
                'unit_cost' => 'required|numeric|min:0',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Retrieve the input data
            $quantity = $request->input('quantity');
            $unitCost = $request->input('unit_cost');

            // Constants
            $profitMargin = 0.25;
            $resultData = shippingPartners::where('status', "Active")->first();

            $shippingCost = $resultData->shipment_cost;
            // Calculate cost
            $cost = $quantity * $unitCost;
            // Calculate selling price
            $sellingPrice = ($cost / (1 - $profitMargin)) + $shippingCost;
            $sell = new coffee();
            $sell->quantity  =   $quantity;
            $sell->unit_cost  =   $unitCost;
            $sell->selling_price  =   $sellingPrice;

            $sell->save();
            return redirect(url('/sales'))->withSuccess("added successfully");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
