<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        if ($order->save()) {
            foreach ($request->order_products as $key => $order_product) {
                $orderProducts = new OrderProducts();
                $orderProducts->order_id = $order->id;
                $orderProducts->product_id = $order_product['product_id'];
                $orderProducts->quantity = $order_product['quantity'];
                $orderProducts->save();
            }
            $order->orderProducts;
            return response()->json($order, 200);
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
        $order = Order::with(['customer', 'orderProducts', 'orderProducts.product'])->find($id);
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $order = Order::find($id);
        $order->customer_id = $request->customer_id;
        if ($order->save()) {
            foreach ($request->order_products as $key => $order_product) {
                if (isset($order_product['id'])) {
                    $orderProducts = OrderProducts::find($order_product['id']);
                    $orderProducts->order_id = $order->id;
                    $orderProducts->product_id = $order_product['product_id'];
                    $orderProducts->quantity = $order_product['quantity'];
                    $orderProducts->save();
                } else {
                    $orderProducts = new OrderProducts();
                    $orderProducts->order_id = $order->id;
                    $orderProducts->product_id = $order_product['product_id'];
                    $orderProducts->quantity = $order_product['quantity'];
                    $orderProducts->save();
                }
            }
            $order->orderProducts;
            return response()->json($order, 200);
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
        $order = Order::find($id);
        if ($order->delete()) {
            return response()->json(
                [
                    'message' => 'Order deleted successfully',
                    'status_code' => 204,
                ],
                204
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
