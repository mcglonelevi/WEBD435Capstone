<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Customer;

class OrdersTest extends TestCase
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
        $response = $this->actingAs($this->getAdminUser())->get('/orders');
        $response->assertStatus(200);
    }

    public function testIndexFail()
    {
        $response = $this->get('/orders');
        $response->assertStatus(403);
    }

    public function testShow()
    {
        $response = $this->actingAs($this->getAdminUser())->get('/orders/10101');
        $response->assertStatus(200);
    }

    public function testShowFail()
    {
        $response = $this->get('/orders/10101');
        $response->assertStatus(403);
    }
}
