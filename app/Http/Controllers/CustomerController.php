<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $customers = Customer::with(['address','profile','company'])->get();
        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->username = $request->username;
        $customer->firstName = $request->firstName;
        $customer->lastName = $request->lastName;
        $customer->email = $request->email;
        $customer->is_client = $request->is_client;
        $customer->address_id = $request->address_id;
        $customer->profile_id = $request->profile_id;
        $customer->company_id = $request->company_id;
        if ($customer->save()) {
            return response()->json($customer);
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred, please try agian',
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
        $customer = Customer::find($id);
        if ($customer) {
            return response()->json($customer);
        } else {
            return response()->json(
                [
                    'message' => 'Customer not found',
                    'status_code' => 404
                ],
                404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->name = $request->name;
            $customer->username = $request->username;
            $customer->firstName = $request->firstName;
            $customer->lastName = $request->lastName;
            $customer->email = $request->email;
            $customer->is_client = $request->is_client;
            $customer->address_id = $request->address_id;
            $customer->profile_id = $request->profile_id;
            $customer->company_id = $request->company_id;
            if ($customer->save()) {
                return response()->json($customer);
            } else {
                return response()->json(
                    [
                        'message' => 'Some error occurred, please try agian',
                        'status_code' => 500
                    ],
                    500
                );
            }
        } else {
            return response()->json(
                [
                    'message' => 'Customer not found',
                    'status_code' => 404
                ],
                404
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $cusomer = Customer::find($id);
        if($cusomer->delete())
        {
            return response()->json(
                [
                    'message' => 'Customer deleted successfully',
                    'status_code' => 204
                ],
                204
            );
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred, please try agian',
                    'status_code' => 500
                ],
                500
            );
        }

    }
}
