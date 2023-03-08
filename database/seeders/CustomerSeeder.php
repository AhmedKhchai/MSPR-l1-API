<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = Http::get('http://615f5fb4f7254d0017068109.mockapi.io/api/v1/customers/')
            ->body();

        $customers = json_decode($response);

        foreach ($customers as $customer) {
            $newCustomer = new Customer();

            $newCustomer->name = $customer->name;
            $newCustomer->username = $customer->username;
            $newCustomer->firstName = $customer->firstName;
            $newCustomer->lastName = $customer->lastName;
            $newCustomer->email = $customer->email ?? null;
            $newCustomer->created_at = $customer->createdAt;

            $address = new Address();
            $address->postalCode = $customer->address->postalCode;
            $address->city = $customer->address->city;
            $address->save();
            $newCustomer->address_id = $address->id;

            $profile = new Profile();
            $profile->firstName = $customer->profile->firstName;
            $profile->lastName = $customer->profile->lastName;
            $profile->save();
            $newCustomer->profile_id = $profile->id;

            $company = new Company();
            $company->companyName = $customer->company->companyName;
            $company->save();
            $newCustomer->company_id = $company->id;

            $newCustomer->save();
        }
    }
}
