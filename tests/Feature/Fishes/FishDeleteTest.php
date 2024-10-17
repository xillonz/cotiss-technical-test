<?php

use App\Models\Fishes;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can delete a fish', function () {
    $fish = Fishes::factory()->create();

    $response = $this->delete("/api/fishes/$fish->id");

    $response->assertStatus(200);

    $this->assertSoftDeleted($fish);
});


