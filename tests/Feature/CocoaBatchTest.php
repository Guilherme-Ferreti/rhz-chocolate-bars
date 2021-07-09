<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CocoaBatch;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;

class CocoaBatchTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_cocoa_batches_can_be_retrieved()
    {
        $this->seed();

        $cocoa_batches = CocoaBatch::with('chocolate_bars')->take(15)->get()->toArray();

        $response = $this->get(route('cocoa-batches.index'), $this->headers());

        $response->assertOk();
        $response->assertJson(['data' => $cocoa_batches]);
    }

    public function test_a_cocoa_batch_can_be_retrieved()
    {
        $this->seed();

        $cocoa_batch = CocoaBatch::with('chocolate_bars')->inRandomOrder()->first()->toArray();

        $response = $this->get(route('cocoa-batches.show', $cocoa_batch['id']), $this->headers());

        $response->assertOk();
        $response->assertJson(['data' => $cocoa_batch]);
    }

    public function test_a_cocoa_batch_can_be_created()
    {
        $cocoa_batch = CocoaBatch::factory()->make()->toArray();

        $response = $this->postJson(route('cocoa-batches.store'), $cocoa_batch, $this->headers());

        $response->assertCreated();
        $response->assertJson(['data' => $cocoa_batch]);

        $this->assertDatabaseCount('cocoa_batches', 1);
    } 

    public function test_a_cocoa_batch_can_be_updated()
    {
        $this->seed();

        $cocoa_batch = CocoaBatch::inRandomOrder()->first()->toArray();

        $cocoa_batch['description'] = 'Updated description';

        $response = $this->putJson(route('cocoa-batches.update', $cocoa_batch['id']), $cocoa_batch, $this->headers());

        $response->assertOk();
        $response->assertJson(['data' => $cocoa_batch]);
        
        $this->assertDatabaseHas('cocoa_batches', [
            'description' => $cocoa_batch['description'],
        ]);
    }

    public function test_a_cocoa_batch_can_be_deleted()
    {
        $this->seed();

        $cocoa_batch = CocoaBatch::inRandomOrder()->first();

        $response = $this->delete(route('cocoa-batches.destroy', $cocoa_batch), [],$this->headers());

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDeleted($cocoa_batch);
    }

    private function headers() : array
    {
        return [
            'X-Auth-Token' => config('app.api_auth_token'),
        ];
    }
}
