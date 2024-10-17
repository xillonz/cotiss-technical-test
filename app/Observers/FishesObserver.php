<?php

namespace App\Observers;

use App\Models\Fishes;

class FishesObserver
{
    /**
     * Handle the Fishes "created" event.
     */
    public function created(Fishes $fish): void
    {
        // Do what needs to be done to notify third parties (i.e. call webhooks) 
    }

    /**
     * Handle the Fishes "updated" event.
     */
    public function updated(Fishes $fish): void
    {
        // Do what needs to be done to notify third parties (i.e. call webhooks) 
    }

    /**
     * Handle the Fishes "deleted" event.
     */
    public function deleted(Fishes $fish): void
    {
        // Do what needs to be done to notify third parties (i.e. call webhooks) 
    }

    /**
     * Handle the Fishes "creating" event.
     */
    public function creating(Fishes $fish): void
    {
        $fish->verifyFish();
    }

    /**
     * Handle the Fishes "updating" event.
     */
    public function updating(Fishes $fish): void
    {
        $fish->verifyFish();
    }
}
