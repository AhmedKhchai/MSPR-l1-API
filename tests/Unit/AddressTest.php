<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the index method of the AddressController.
     *
     * @return void
     */
    public function testIndex()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
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
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
        $data = Address::factory()->make()->toArray();
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
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
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
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
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
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
        $address = Address::factory()->create();
        $response = $this->delete('/api/address/' . $address->id);
        $response->assertStatus(204);
    }

    public function testHasCustomer()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['superadmin']
        );
        $address = Address::factory()->hasCustomers(2, [
            'is_client' => '1',
        ])->create();
        $response = $this->get('/api/address/' . $address->id);
        Log::info($address->customers);
        $response->assertStatus(200);
    }
}
