<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Customer;

class ProductsTest extends TestCase
{
    protected function getAdminUser()
    {
        $customer = factory(Customer::class)->create();
        $user = factory(User::class)->create([
            'customerNumber' => $customer->customerNumber,
        ]);
        $user->is_admin = true;
        return $user;
    }

    protected function getUser()
    {
        $customer = factory(Customer::class)->create();
        $user = factory(User::class)->create([
            'customerNumber' => $customer->customerNumber,
        ]);
        $user->is_admin = false;
        return $user;
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $response = $this->get('/products/S12_1099');
        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->getAdminUser())
                        ->get('/products/create');
        $response->assertStatus(200);
    }

    public function testCreateFail()
    {
        $response = $this->actingAs($this->getUser())
                        ->get('/products/create');
        $response->assertStatus(403);
    }

    public function testEdit()
    {
        $response = $this->actingAs($this->getAdminUser())
                        ->get('/products/S12_1099/edit');
        $response->assertStatus(200);
    }

    public function testEditFail()
    {
        $response = $this->actingAs($this->getUser())
                        ->get('/products/S12_1099/edit');
        $response->assertStatus(403);
    }
}
