<?php

namespace App\Models;

use Error;
use App\Observers\FishesObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([FishesObserver::class])]
class Fishes extends Model
{
    use HasFactory, SoftDeletes;

    public function verifyFish(): void
    {
        // Could change/outsource this verification logic to whatever makes sense for the application
        $this->verified = in_array($this->name, [
            "Goldfish",
            "Kingfish",
            "Snapper",
            "Salmon",
            "Tuna"
        ]);
    }
}
