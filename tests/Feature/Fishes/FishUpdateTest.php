<?php

use App\Models\Fishes;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can update a fish', function () {
    $fish = Fishes::factory()->create();
    $testName = 'TEST';

    $response = $this->patch("/api/fishes/$fish->id", [
        'name' => $testName,
        'description' => $fish->description,
        'updated_at' => $fish->updated_at->format('Y-m-d H:i:s'),
    ]);

    $response->assertStatus(200);

    $this->assertDatabaseHas('fishes', [
        'id' => $fish->id,
        'name' => $testName
    ]);        
});

test('cannot update an out of date fish', function () {
    $fish = Fishes::factory()->create();
    $testName = 'TEST';

    $response = $this->patch("/api/fishes/$fish->id", [
        'name' => $testName,
        'description' => $fish->description,
        'updated_at' => '2024-09-01 00:00:00',
    ]);

    $response->assertStatus(400);

    $this->assertDatabaseMissing('fishes', [
        'id' => $fish->id,
        'name' => $testName
    ]);        
});


