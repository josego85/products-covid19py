<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Models\Seller;
use App\Repositories\SellerRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private SellerRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new SellerRepository(new User());
    }

    // public function testGetSellers(): void
    // {
    //     // Create test sellers
    //     Seller::factory()->count(3)->create();

    //     $sellers = $this->repository->getSellers();
        
    //     $this->assertCount(3, $sellers);
    // }

    public function testGetSellerById(): void
    {
        $seller = Seller::factory()->create();

        $result = $this->repository->getSeller($seller->id);

        $this->assertNotNull($result);
        $this->assertEquals($seller->id, $result->id);
    }

    public function testSetUser(): void
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'status' => 'active'
        ];

        $userId = $this->repository->setUser($userData);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'status' => 'active'
        ]);
    }
}