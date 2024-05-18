<?php

namespace App\Http\Controllers;

use App\Models\coffeeProduct;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\shippingPartners;

class CoffeeProductController extends Controller
{
    public function index()
    {
        $listingData['data'] = coffeeProduct::all();

        return view('coffe_product_sales', $listingData);
    }
    public function create()
    {
        return view('coffe_product_sales_add');
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
            $product_name = $request->input('product_name');

            $quantity = $request->input('quantity');
            $unitCost = $request->input('unit_cost');

            // Constants
            $profitMargin = 0.15;
            $resultData = shippingPartners::where('status', "Active")->first();

            $shippingCost = $resultData->shipment_cost;
            // Calculate cost
            $cost = $quantity * $unitCost;
            // Calculate selling price
            $sellingPrice = ($cost / (1 - $profitMargin)) + $shippingCost;
            $sell = new coffeeProduct();
            $sell->product_name  =   $product_name;
            $sell->quantity  =   $quantity;
            $sell->unit_cost  =   $unitCost;
            $sell->selling_price  =   $sellingPrice;

            $sell->save();
            return redirect(url('/sales-product'))->withSuccess("added successfully");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
