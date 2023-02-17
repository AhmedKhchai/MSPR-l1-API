<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class AddressControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * Test the index method of the AddressController.
     *
     * @return void
     */
    public function testIndex()
    {
        $addresses = Address::factory()->count(3)->create();
        $response = $this->get('/api/address');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /**
     * Test the store method of the AddressController.
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'postalCode' => $this->faker->postcode,
            'city' => $this->faker->city,
        ];
        $response = $this->postJson('/api/address', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('addresses', $data);
    }

    /**
     * Test the show method of the AddressController.
     *
     * @return void
     */
    public function testShow()
    {
        $address = Address::factory()->create();
        $response = $this->get('/api/address/' . $address->id);
        $response->assertStatus(200);
        $response->assertJson([
            'postalCode' => $address->postalCode,
            'city' => $address->city,
        ]);
    }

    /**
     * Test the update method of the AddressController.
     *
     * @return void
     */
    public function testUpdate()
    {
        $address = Address::factory()->create();
        $data = [
            'postalCode' => $this->faker->postcode,
            'city' => $this->faker->city,
        ];
        $response = $this->putJson('/api/address/' . $address->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('addresses', $data);
    }

    /**
     * Test the destroy method of the AddressController.
     *
     * @return void
     */
    public function testDestroy()
    {
        $address = Address::factory()->create();
        $response = $this->delete('/api/address/' . $address->id);
        $response->assertStatus(204);
    }
}