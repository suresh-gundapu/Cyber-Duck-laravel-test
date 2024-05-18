<?php

namespace App\Http\Controllers;

use App\Models\shippingPartners;
use Exception;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ShippingPartnersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listingData['data'] = shippingPartners::all();

        return view('shipping_partners', $listingData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shipping_partners_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $inputParams = $request->all();
            $validator = validator::make($request->all(), [
                "shipment_cost" => "required",
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $shipment = new shippingPartners();
            $shipment->shipment_cost = $inputParams['shipment_cost'];
            $shipment->save();
            return redirect(url('/shipping-partners'))->withSuccess("added successfully");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $paramsList['data'] = shippingPartners::where('id', $id)->first();
        if (empty($paramsList['data'])) {

            return redirect(url('/shipping-partners'))->withWarnings('No record Founds');
        }
        return view('shipping_partners_edit', $paramsList);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $inputParams = $request->all();
            $shipmentId = $inputParams['id'];
            $shippingPartnersData = shippingPartners::where('id', $shipmentId)->first();
            $shippingPartnersData->shipment_cost = $inputParams['shipment_cost'];
            $shippingPartnersData->save();
            return redirect(url('/shipping-partners'))->with('success', "Updated successfully")->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $paramsArray = $request->all();
            $users = shippingPartners::where('id', $paramsArray['id'])->delete();
            $returnArray['success'] = "1";
            $returnArray['message'] = 'Deleted successfully';
        } catch (\Exception $e) {
            $returnArray['success'] = "0";
            $returnArray['message'] = $e->getMessage();
        }
        return response()->json($returnArray, 200);
    }

    public function changeStatus(Request $request)
    {
        try {

            $paramsArray = $request->all();
            if ($paramsArray['status'] == "Active") {
                $status_code_final = "Inactive";
            } else {
                $status_code_final = "Active";
            }
            $values = array('status' =>  $status_code_final);
            shippingPartners::where('id', $paramsArray['id'])->update($values);
            $retArr['success'] = "1";
            $retArr['message'] = 'Successfully Updated';
        } catch (\Exception $e) {
            $retArr['success'] = "0";
            $retArr['message'] = $e->getMessage();
        }
        return response()->json($retArr, 200);
    }
}
