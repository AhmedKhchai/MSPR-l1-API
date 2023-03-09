<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $orders = Order::with(['customer', 'orderProducts', 'products', 'products.productDetail'])->get();

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
                $product = Product::find($order_product['product_id']);
                if ($product->stock < $order_product['quantity']) {
                    $order->delete();
                    return response()->json(
                        [
                            'message' => 'Product quantity is not available',
                            'status_code' => 500,
                        ],
                        500
                    );
                }
                $product->stock = $product->stock - $order_product['quantity'];
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
        if ($order) {
            return response()->json($order);
        } else {
            return response()->json(
                [
                    'message' => 'Order not found',
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
     * Remove the Order resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $order = Order::find($id);
        $orderProducts = $order->orderProducts;
        foreach ($orderProducts as $key => $orderProduct) {
            $product = $orderProduct->product;
            $product->stock = $product->stock + $orderProduct->quantity;
            $product->save();
        }
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

    /**
     * Remove the Product from Order resource from storage.
     */
    public function deleteProductFromOrder(string $id, string $productId): JsonResponse
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(
                [
                    'message' => 'Order not found',
                    'status_code' => 404,
                ],
                404
            );
        }
        if (!$order->orderProducts->contains('product_id', $productId)) {
            return response()->json(
                [
                    'message' => 'Product not found in order',
                    'status_code' => 404,
                ],
                404
            );
        }
        $orderProducts = $order->orderProducts;
        foreach ($orderProducts as $key => $orderProduct) {
            if ($orderProduct->product_id == $productId) {
                $product = $orderProduct->product;
                $product->stock = $product->stock + $orderProduct->quantity;
                $product->save();
                $orderProduct->delete();
            }
        }
        return response()->json(
            [
                'message' => 'Product deleted successfully',
                'status_code' => 204,
            ],
            204
        );
    }
}