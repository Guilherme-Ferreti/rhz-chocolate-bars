<?php

namespace Database\Seeders;

use App\Models\CocoaBatch;
use App\Models\ChocolateBar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ChocolateBarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chocolate_bars = ChocolateBar::factory(1)->create(['weight' => 100]);

        foreach ($chocolate_bars as $chocolate_bar) {
            $cocoa_batches = CocoaBatch::factory()
                                        ->count(3)
                                        ->state(new Sequence(
                                            ['origin' => CocoaBatch::ORIGINS['organic']],
                                            ['origin' => CocoaBatch::ORIGINS['preprocessed']],
                                            ['origin' => CocoaBatch::ORIGINS['preprocessed']],
                                        ))
                                        ->create();

            $chocolate_bar->cocoa_batches()->attach([
                $cocoa_batches[0]->id => ['grams' => 90],
                $cocoa_batches[1]->id => ['grams' => 5],
                $cocoa_batches[2]->id => ['grams' => 5],
            ]);
        }
    }
}
