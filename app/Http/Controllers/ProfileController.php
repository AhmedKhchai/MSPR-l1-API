<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $profiles = Profile::all();

        return response()->json($profiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $profile = new Profile();
        $profile->firstName = $request->firstName;
        $profile->lastName = $request->lastName;
        if ($profile->save()) {
            return response()->json($profile);
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred, please try agian',
                    'status_code' => 500,
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
        $profile = Profile::find($id);
        if ($profile) {
            return response()->json($profile);
        } else {
            return response()->json(
                [
                    'message' => 'Profile not found',
                    'status_code' => 404,
                ],
                404
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $profile = Profile::find($id);
        $profile->firstName = $request->firstName;
        $profile->lastName = $request->lastName;
        if ($profile->save()) {
            return response()->json($profile);
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred, please try agian',
                    'status_code' => 500,
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
        $profile = Profile::find($id);
        if ($profile->delete()) {
            return response()->json(
                [
                    'message' => 'Profile deleted successfully',
                    'status_code' => 200,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'message' => 'Some error occurred, please try agian',
                    'status_code' => 500,
                ],
                500
            );
        }
    }
}
