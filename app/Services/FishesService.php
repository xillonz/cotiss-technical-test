<?php

namespace App\Services;

use App\Models\Fishes;
use App\Types\OrderType;
use Illuminate\Pagination\LengthAwarePaginator;

class FishesService
{
    public function getPaginatedFishes(int $perPage, int $page = 1, OrderType $order = OrderType::ASC): LengthAwarePaginator
    {
        return Fishes::orderBy(column: 'created_at', direction: $order->value)->paginate(perPage: $perPage, page: $page);
    }

    public function getFish(int $id): Fishes
    {
        return Fishes::find($id);
    }

    public function storeFish(string $name, string $description, int $lifespan, int $length): void
    {
        $fish = new Fishes();
        $fish->name = $name;
        $fish->description = $description;
        $fish->lifespan = $lifespan;
        $fish->length = $length;
        $fish->save();
    }

    public function updateFish(int $id, string $name, string $description, ?int $lifespan, ?int $length): void
    {
        Fishes::where('id', $id)
            ->update([
                'name' => $name,
                'description' => $description,
                'lifespan' => $lifespan,
                'length' => $length
            ]);
    }

    public function deleteFish($id): void
    {
        Fishes::where('id', $id)->delete();
    }
}
