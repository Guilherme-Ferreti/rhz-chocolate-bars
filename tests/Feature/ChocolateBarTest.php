<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\CocoaBatch;
use App\Models\ChocolateBar;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ChocolateBarTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_chocolate_bars_can_be_retrieved()
    {
        $this->seed();

        $response = $this->get(route('chocolate-bars.index'), $this->headers());
        
        $response->assertOk();

        $response->assertJson(['data' => ChocolateBar::with('cocoa_batches')->get()->toArray()]);
    }

    public function test_a_chocolate_bar_can_be_retrieved()
    {
        $this->seed();

        $chocolate_bar = ChocolateBar::with('cocoa_batches')->inRandomOrder()->first()->toArray();

        $response = $this->get(route('chocolate-bars.show', $chocolate_bar['id']), $this->headers());

        $response->assertOk();
        $response->assertJson(['data' => $chocolate_bar]);
    }

    public function test_a_chocolate_bar_can_be_created()
    {
        $cocoa_batches = $this->create_cocoa_batches();

        $payload = [
            'weight' => 100,
            'code' => '12345678',
            'cocoa_batches' => [
                ['id' => $cocoa_batches[0]->id, 'grams' => 90],
                ['id' => $cocoa_batches[1]->id, 'grams' => 10],
            ]
        ];

        $response = $this->postJson(route('chocolate-bars.store'), $payload, $this->headers());

        $response->assertCreated();
        $response->assertJson(['data' => ChocolateBar::with('cocoa_batches')->first()->toArray()]);
    }

    public function test_a_chocolate_bar_can_be_updated()
    {
        $this->seed();

        $cocoa_batches = $this->create_cocoa_batches();

        $payload = [
            'weight' => 100,
            'code' => 'code1234',
            'cocoa_batches' => [
                ['id' => $cocoa_batches[0]->id, 'grams' => 95],
                ['id' => $cocoa_batches[1]->id, 'grams' => 5],
            ]
        ];

        $response = $this->putJson(route('chocolate-bars.update', ChocolateBar::first()), $payload, $this->headers());

        $response->assertOk();

        $this->assertDatabaseHas('chocolate_bars', ['code' => 'code1234']);
        $this->assertDatabaseHas('chocolate_bar_cocoa_batch', ['id' => $cocoa_batches[0]->id, 'grams' => 95]);
        $this->assertDatabaseHas('chocolate_bar_cocoa_batch', ['id' => $cocoa_batches[1]->id, 'grams' => 5]);
    }

    public function test_a_chocolate_bar_can_be_deleted()
    {
        $this->seed();

        $chocolate_bar = ChocolateBar::first();

        $response = $this->deleteJson(route('chocolate-bars.destroy', $chocolate_bar), [], $this->headers());

        $response->assertNoContent();

        $this->assertDeleted('chocolate_bars', $chocolate_bar->toArray());
    }

    private function create_cocoa_batches()
    {
        return CocoaBatch::factory()
                        ->count(2)
                        ->state(new Sequence(
                            ['origin' => CocoaBatch::ORIGINS['organic']],
                            ['origin' => CocoaBatch::ORIGINS['preprocessed']],
                        ))
                        ->create();
    }

    private function headers() : array
    {
        return [
            'X-Auth-Token' => config('app.api_auth_token'),
        ];
    }
}
