<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {   
        $companies = Company::all();
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $company = new Company();
        $company->companyName = $request->companyName;
        if($company->save()){
            return response()->json($company);
        }else {
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
    public function show(string $id): JsonResponse
    {
        $company = Company::find($id);
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $company = Company::find($id);
        $company->companyName = $request->companyName;
        if($company->save()){
            return response()->json($company);
        }else {
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $company = Company::find($id);
        if($company->delete()){
            return response()->json(
                [
                    'message' => 'Company deleted successfully',
                    'status_code' => 200
                ],
                200
            );
        }else{
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
