<?php

namespace App\Http\Controllers;

use App\Models\Fishes;
use App\Types\OrderType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\FishesService;
use App\Http\Resources\FishResource;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\ResponseFactory;
use App\Http\Resources\FishesCollection;
use App\Http\Requests\StoreFishesRequest;
use App\Http\Requests\UpdateFishesRequest;
use App\Http\Resources\FishListingResource;
use App\Exceptions\ConcurrentEditingException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FishesController extends Controller
{

    public function __construct(
        protected FishesService $fishesService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        Gate::authorize('viewAny', Fishes::class);

        $order = $request->input("order", OrderType::ASC->value);
        $page = $request->input("page",1);

        $paginatedList = $this->fishesService->getPaginatedFishes(5, $page, OrderType::{$order});

        return FishListingResource::collection($paginatedList);
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(StoreFishesRequest $request): Response|ResponseFactory
    {
        Gate::authorize('create', Fishes::class);

        $this->fishesService->storeFish(
            $request->input('name'),
            $request->input('description'),
            $request->input('lifespan'),
            $request->input('length')
        );

        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fishes $fish): FishResource
    {
        Gate::authorize('view', $fish);

        return new FishResource($fish);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFishesRequest $request, Fishes $fish): void
    {
        Gate::authorize('update', $fish);

        // At the moment just throwing an error if the user is not editing the latest version of the fish, better UX dependant on product requirements
        if($fish->updated_at->format('Y-m-d H:i:s') !== $request->input('updated_at')) throw new ConcurrentEditingException();

        $this->fishesService->updateFish(
            $fish->id, 
            $request->input('name'),
            $request->input('description'),
            $request->input('lifespan'),
            $request->input('length')
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fishes $fish): void
    {
        Gate::authorize('delete', $fish);

        $this->fishesService->deleteFish($fish->id);
    }
}
