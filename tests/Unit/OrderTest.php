<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the index method of the CustomerController.
     *
     * @return void
     */
    public function testIndex()
    {
        Order::factory()->count(3)->create();
        $response = $this->get('/api/orders');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /**
     * Test the store method of the CustomerController.
     *
     * @return void
     */
    public function testStore()
    {
        $customer = Customer::factory()->create();
        $nbOrderProducts = $this->faker->numberBetween(2, 5);
        $order_products = [];
        for ($i = 0; $i < $nbOrderProducts; $i++) {
            array_push($order_products, [
                'product_id' => Product::factory()->create()['id'],
                'quantity' => $this->faker->numberBetween(1, 10),
            ]);
        }
        $data = [
            'customer_id' => $customer->id,
            'order_products' => $order_products,
        ];

        $response = $this->postJson('/api/orders', $data);
        $response->assertStatus(200);
    }

    /**
     * Test the show method of the CustomerController.
     *
     * @return void
     */
    public function testShow()
    {
        $order = Order::factory()->create();
        $response = $this->get('/api/orders/' . $order['id']);
        $response->assertStatus(200);
    }

    /**
     * Test the update method of the CustomerController.
     *
     * @return void
     */
    public function testUpdate()
    {
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $customer = Customer::factory()->create();
        $order->customer_id = $customer->id;
        $data = [
            'customer_id' => $customer->id,
            'order_products' => [
                [
                    'product_id' => $product->id,
                    'quantity' => $this->faker->numberBetween(1, 10),
                ],
            ],
        ];
        $response = $this->putJson('/api/orders/' . $order['id'], $data);
        $response->assertStatus(200);
    }

    /**
     * Test the destroy method of the CustomerController.
     *
     * @return void
     */
    public function testDestroy()
    {
        $order = Order::factory()->create();
        $response = $this->delete('/api/orders/' . $order['id']);
        $response->assertStatus(204);
    }
}