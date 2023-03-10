<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
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
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
        $orders = Order::factory()->count(3)->create();
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
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $data = [
            'customer_id' => $customer['id'],
            'product_id' => $product['id'],
            'quantity' => $this->faker->numberBetween(0, 100),
        ];

        $response = $this->postJson('/api/orders', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', $data);
    }

    /**
     * Test the show method of the CustomerController.
     *
     * @return void
     */
    public function testShow()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
        $order = Order::factory()->create();
        $response = $this->get('/api/orders/' . $order['id']);
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $order['id'],
            'quantity' => $order['quantity'],
        ]);
    }

    /**
     * Test the update method of the CustomerController.
     *
     * @return void
     */
    public function testUpdate()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
        $order = Order::factory()->create();
        $product = Product::factory()->create();
        $customer = Customer::factory()->create();
        $data = [
            'product_id' => $product['id'],
            'customer_id' => $customer['id'],
            'quantity' => $this->faker->numberBetween(0, 100),
        ];
        $response = $this->putJson('/api/orders/' . $order['id'], $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('orders', $data);
    }

    /**
     * Test the destroy method of the CustomerController.
     *
     * @return void
     */
    public function testDestroy()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
        $order = Order::factory()->create();
        $response = $this->delete('/api/orders/' . $order['id']);
        $response->assertStatus(204);
    }
}
