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
        $cocoa_batches = CocoaBatch::factory(10)->create()->toArray();

        $response = $this->get(route('cocoa-batches.index'));

        $response->assertOk();
        $response->assertExactJson($cocoa_batches);
    }

    public function test_a_cocoa_batch_can_be_retrieved()
    {
        $cocoa_batch = CocoaBatch::factory()->create();

        $response = $this->get(route('cocoa-batches.show', $cocoa_batch));

        $response->assertOk();
        $response->assertExactJson($cocoa_batch->toArray());
    }

    public function test_a_cocoa_batch_can_be_created()
    {
        $cocoa_batch = CocoaBatch::factory()->make()->toArray();

        $response = $this->postJson(route('cocoa-batches.store'), $cocoa_batch);

        $response->assertCreated();
        $response->assertJson($cocoa_batch);

        $this->assertDatabaseCount('cocoa_batches', 1);
    } 

    public function test_a_cocoa_batch_can_be_updated()
    {
        $cocoa_batch = CocoaBatch::factory()->create()->toArray();

        $cocoa_batch['description'] = 'Updated description';

        $response = $this->putJson(route('cocoa-batches.update', $cocoa_batch['id']), $cocoa_batch);

        $response->assertOk();
        $response->assertExactJson($cocoa_batch);

        unset($cocoa_batch['updated_at']);

        $this->assertDatabaseHas('cocoa_batches', [
            'description' => $cocoa_batch['description'],
        ]);
    }

    public function test_a_cocoa_batch_can_be_deleted()
    {
        $cocoa_batch = CocoaBatch::factory()->create();

        $response = $this->delete(route('cocoa-batches.destroy', $cocoa_batch));

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDeleted($cocoa_batch);
    }
}
