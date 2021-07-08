<?php

namespace App\Http\Controllers;

use App\Models\CocoaBatch;
use Illuminate\Http\Request;
use App\Http\Requests\CocoaBatchRequest;
use App\Http\Resources\CocoaBatchResource;
use Symfony\Component\HttpFoundation\Response;

class CocoaBatchController extends Controller
{
    public function index()
    {
        $cocoa_batches = CocoaBatch::with('chocolate_bars')->paginate();

        return CocoaBatchResource::collection($cocoa_batches);
    }

    public function store(CocoaBatchRequest $request)
    {
        $cocoa_batch = CocoaBatch::create($request->validated());

        return (new CocoaBatchResource($cocoa_batch))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CocoaBatch $cocoa_batch)
    {
        $cocoa_batch->load('chocolate_bars');

        return new CocoaBatchResource($cocoa_batch);
    }

    public function update(CocoaBatchRequest $request, CocoaBatch $cocoa_batch)
    {
        $cocoa_batch->update($request->validated());
        
        $cocoa_batch->load('chocolate_bars');

        return new CocoaBatchResource($cocoa_batch);
    }

    public function destroy(CocoaBatch $cocoa_batch)
    {
        $cocoa_batch->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }
}
