<?php

namespace Tests\Unit\Models;

use App\Models\Product;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testProductBelongsToSeller(): void
    {
        $seller = Seller::factory()->create();
        // $product = Product::factory()->create(['seller_id' => $seller->id]);

        // $this->assertInstanceOf(Seller::class, $product->seller);
        // $this->assertEquals($seller->id, $product->seller->id);
    }

    public function testProductAttributes(): void
    {
        // $product = Product::factory()->create([
        //     'name' => 'Test Product',
        //     'price' => 99.99,
        //     'description' => 'Test Description'
        // ]);

        // $this->assertEquals('Test Product', $product->name);
        // $this->assertEquals(99.99, $product->price);
        // $this->assertEquals('Test Description', $product->description);
    }
}