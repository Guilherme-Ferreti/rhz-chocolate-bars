<?php

namespace App\Http\Controllers;

use App\Models\ChocolateBar;
use App\Http\Requests\ChocolateBarRequest;
use App\Http\Resources\ChocolateBarResource;
use Symfony\Component\HttpFoundation\Response;

class ChocolateBarController extends Controller
{
    public function index()
    {
        $chocolate_bars = ChocolateBar::with('cocoa_batches')->paginate();

        return ChocolateBarResource::collection($chocolate_bars);
    }

    public function store(ChocolateBarRequest $request)
    {
        $attributes = $request->validated();

        $chocolate_bar = ChocolateBar::create($attributes);

        foreach ($attributes['cocoa_batches'] as $cocoa_batch) {
            $chocolate_bar->cocoa_batches()->attach($cocoa_batch['id'], [
               'grams' => $cocoa_batch['grams'],
            ]);
        }

        $chocolate_bar->load('cocoa_batches');

        return (new ChocolateBarResource($chocolate_bar))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ChocolateBar $chocolate_bar)
    {
        $chocolate_bar->load('cocoa_batches');

        return new ChocolateBarResource($chocolate_bar);
    }

    public function update(ChocolateBarRequest $request, ChocolateBar $chocolate_bar)
    {
        $attributes = $request->validated();

        $chocolate_bar->update($attributes);

        $chocolate_bar->cocoa_batches()->detach();

        foreach ($attributes['cocoa_batches'] as $cocoa_batch) {
            $chocolate_bar->cocoa_batches()->attach($cocoa_batch['id'], [
               'grams' => $cocoa_batch['grams'],
            ]);
        }

        $chocolate_bar->load('cocoa_batches');

        return new ChocolateBarResource($chocolate_bar);
    }

    public function destroy(ChocolateBar $chocolate_bar)
    {
        $chocolate_bar->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
