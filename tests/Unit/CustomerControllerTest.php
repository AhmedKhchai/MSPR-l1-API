<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;


class CustomerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * Test the index method of the CustomerController.
     *
     * @return void
     */
    public function testIndex()
    {
        $customers = Customer::factory()->count(3)->create();
        $response = $this->get('/api/customers');
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
        $data = Customer::factory()->make()->toArray();
        $response = $this->postJson('/api/customers', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('customers', $data);
    }

    /**
     * Test the show method of the CustomerController.
     *
     * @return void
     */
    public function testShow()
    {
        $customer = Customer::factory()->create();
        $response = $this->get('/api/customers/' . $customer['id']);
        $response->assertStatus(200);
        $response->assertJson([
            'name' => $customer['name'],
            'email' => $customer['email'],
        ]);
    }

    /**
     * Test the update method of the CustomerController.
     *
     * @return void
     */
    public function testUpdate()
    {
        $customer = Customer::factory()->create();
        $address = Address::factory()->create();
        $profile = Profile::factory()->create();
        $company = Company::factory()->create();
        $data = [
            "name" => $this->faker->name,
            "username" => $this->faker->userName,
            "firstName" => $this->faker->firstName,
            "lastName" => $this->faker->lastName,
            "email" => $this->faker->email,
            "is_client" => $this->faker->boolean,
            "address_id" => $address['id'],
            "profile_id" => $profile['id'],
            "company_id" => $company['id'],
        ];
        $response = $this->putJson('/api/customers/' . $customer['id'], $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('customers', $data);
    }

    /**
     * Test the destroy method of the CustomerController.
     *
     * @return void
     */
    public function testDestroy()
    {
        $customer = Customer::factory()->create();
        $response = $this->delete('/api/customers/' . $customer['id']);
        $response->assertStatus(204);
    }
}
