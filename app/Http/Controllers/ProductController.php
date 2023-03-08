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
        $product = Product::with(['productDetail'])->get();
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $productDetail = new ProductDetail();
        $productDetail->price = $request->price;
        $productDetail->description = $request->description;
        $productDetail->color = $request->color;
        $productDetail->save();
        $product = new Product();
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->product_detail_id = $productDetail->id;
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
        $product = Product::with(['productDetail'])->find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $product = Product::find($id);
        $productDetail = $product->productDetail;
        $productDetail->price = $request->price;
        $productDetail->description = $request->description;
        $productDetail->color = $request->color;
        $productDetail->save();

        $product->name = $request->name;
        $product->stock = $request->stock;
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $product = Product::find($id);
        if ($product->delete()) {
            return response()->json(
                [
                    'message' => 'Product deleted successfully',
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
