<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Customer;
use App\Product;

class PublicTest extends TestCase
{

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
    public function testRoot()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function testCheckout()
    {
        $response = $this->actingAs($this->getUser())
                      ->get('/cart/create');
        $response->assertStatus(200);
    }
    public function testContact()
    {
        $response = $this->get('/contact');
        $response->assertStatus(200);
    }
    public function testAbout()
    {
        $response = $this->get('/about');
        $response->assertStatus(200);
    }
    public function testLocations()
    {
        $response = $this->get('/locations');
        $response->assertStatus(200);
    }
    public function testCart()
    {
        $response = $this->get('/cart');
        $response->assertStatus(200);
    }
    public function login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }
    public function register()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
}
