<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductTest extends TestCase
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
        $products = Product::factory()->count(3)->create();
        $response = $this->get('/api/products');
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
        $product = Product::factory()->make();
        $productDetail = ProductDetail::factory()->make();
        $dataProduct = [
            'name' => $product->name,
            'stock' => $product->stock,
        ];
        $dataProductDetail = [
            'price' => $productDetail->price,
            'description' => $productDetail->description,
            'color' => $productDetail->color,
        ];

        $response = $this->postJson('/api/products', array_merge($dataProductDetail, $dataProduct));
        $response->assertStatus(200);
        $this->assertDatabaseHas('product_details', $dataProductDetail);
        $this->assertDatabaseHas('products', $dataProduct);
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
        $product = Product::factory()->create();
        $response = $this->get('/api/products/' . $product['id']);
        $response->assertStatus(200);
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
        $product = Product::factory()->create();
        $productDetail = ProductDetail::factory()->create();

        $data = [
            'id' => $product['id'],
            'product_detail_id' => $productDetail['id'],
            'price' => $productDetail->price,
            'description' => $productDetail->description,
            'color' => $productDetail->color,
            'name' => $product->name,
            'stock' => $product->stock,
        ];

        $response = $this->putJson('/api/products/' . $product['id'], $data);
        $response->assertStatus(200);
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
        $product = Product::factory()->create();
        $response = $this->delete('/api/products/' . $product['id']);
        $response->assertStatus(204);
    }
}