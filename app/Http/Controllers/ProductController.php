<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $product = Product::all();
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $productDetails = new ProductDetail;
        $productDetails->price = $request->price;
        $productDetails->description = $request->description;
        $productDetails->color = $request->color;
        $productDetails->save();
        $product = new Product();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->product_detail_id = $productDetails->id;
        if ($product->save()) {
            return response()->json($product);
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
    public function show(string $id): JsonResponse
    {
        $order = Product::find($id);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $order = Product::find($id);
        $order->customer_id = $request->customer_id;
        if ($order->save()) {
            return response()->json($order);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $order = Product::find($id);
        if ($order->delete()) {
            return response()->json(
                [
                    'message' => 'Product deleted successfully',
                    'status_code' => 200
                ],
                200
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