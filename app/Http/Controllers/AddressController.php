<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $address = new Address();
        $address->postalCode = $request['postalCode'];
        $address->city = $request['city'];
        if ($address->save()) {
            return response()->json($address);
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred, please try again',
                    'status_code' => 500
                ],
                500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $address = Address::find($id);
        return response()->json($address);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $address = Address::find($id);
        $address->postalCode = $request->postalCode;
        $address->city = $request->city;
        if ($address->save()) {
            return response()->json($address);
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred, please try again',
                    'status_code' => 500
                ],
                500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $address = Address::find($id);
        if ($address->delete()) {
            return response()->json(
                [
                    'message' => 'Address deleted successfully',
                    'status_code' => 200
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred, please try again',
                    'status_code' => 500
                ],
                500
            );
        }
    }
}
