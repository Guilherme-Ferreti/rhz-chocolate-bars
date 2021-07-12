<?php

namespace Tests\Feature;

use App\Models\ChocolateBar;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConsultationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_chocolate_bar_can_be_consulted()
    {
        $this->seed();

        $chocolate_bar = ChocolateBar::inRandomOrder()->first()->toArray();

        $response = $this->get(route('consultation.chocolate_bar', ['chocolate_bar' => $chocolate_bar['code']]));

        $response->assertOk();
        $response->assertJson(['data' => $chocolate_bar]);
    }
}
