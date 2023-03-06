<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $orders = Order::with(['customer', 'product', 'product.productDetail'])->get();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
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
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $order = Order::find($id)->with(['customer', 'product', 'product.productDetail'])->get();
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $order = Order::find($id);
        $order->customer_id = $request->customer_id;
        $order->product_id = $request->product_id;
        $order->quantity = $request->quantity;
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
        $order = Order::find($id);
        if ($order->delete()) {
            return response()->json(
                [
                    'message' => 'Order deleted successfully',
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