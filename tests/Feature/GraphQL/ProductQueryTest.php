<?php

namespace Tests\Feature\GraphQL;

use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class ProductQueryTest extends TestCase
{
    use RefreshDatabase;

    public function testQueryProducts(): void
    {
        // Create first seller with user
        $seller1 = Seller::factory()->create([
            'longitude' => -57.55191767938415,
            'latitude' => -25.3514513857158,
            'comment' => null
        ]);
        
        $user1 = User::factory()->create([
            'full_name' => 'José Adorno',
            'email' => 'Jotadorno@gmail.com',
            'phone_number' => '0982395577'
        ]);
        $seller1->user()->associate($user1)->save();

        // Create second seller with user
        $seller2 = Seller::factory()->create([
            'longitude' => -57.49566677772734,
            'latitude' => -25.340880883365916,
            'comment' => null
        ]);
        
        $user2 = User::factory()->create([
            'full_name' => 'Roberto Brusquetti Vargas',
            'email' => 'robrusnet@gmail.com_not',
            'phone_number' => '0972527901'
        ]);
        $seller2->user()->associate($user2)->save();

        $response = $this->graphQL('
            query {
                sellers {
                    id
                    longitude
                    latitude
                    comment
                    user {
                        full_name
                        email
                        phone_number
                    }
                    products(type: "frutas") {
                        name
                    }
                }
            }
        ');

        // Get the actual response data
        $responseData = $response->json();
        
        // Assert the structure matches but allow for floating point precision differences
        $this->assertEquals($seller1->id, $responseData['data']['sellers'][0]['id']);
        $this->assertEquals($seller2->id, $responseData['data']['sellers'][1]['id']);
        
        // Assert coordinates with lower precision
        $this->assertEqualsWithDelta(-57.55191767938415, $responseData['data']['sellers'][0]['longitude'], 0.000001);
        $this->assertEqualsWithDelta(-25.3514513857158, $responseData['data']['sellers'][0]['latitude'], 0.000001);
        $this->assertEqualsWithDelta(-57.49566677772734, $responseData['data']['sellers'][1]['longitude'], 0.000001);
        $this->assertEqualsWithDelta(-25.340880883365916, $responseData['data']['sellers'][1]['latitude'], 0.000001);

        // Assert the rest of the structure
        $this->assertEquals([
            'full_name' => 'José Adorno',
            'email' => 'Jotadorno@gmail.com',
            'phone_number' => '0982395577'
        ], $responseData['data']['sellers'][0]['user']);

        $this->assertEquals([
            'full_name' => 'Roberto Brusquetti Vargas',
            'email' => 'robrusnet@gmail.com_not',
            'phone_number' => '0972527901'
        ], $responseData['data']['sellers'][1]['user']);

        $this->assertEquals([], $responseData['data']['sellers'][0]['products']);
        $this->assertEquals([], $responseData['data']['sellers'][1]['products']);
    }

    private function graphQL(string $query): TestResponse
    {
        return $this->postJson('/graphql', [
            'query' => $query
        ]);
    }
}