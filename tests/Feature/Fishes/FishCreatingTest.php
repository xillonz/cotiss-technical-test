<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can create a fish', function () {
    $fishData = [
        'name' => fake()->name(),
        'description' => fake()->text(),
        'lifespan' => fake()->numberBetween(0, 100),
        'length' => fake()->numberBetween(0,1000)
    ];

    $response = $this->post('/api/fishes', $fishData);

    $response->assertStatus(201);

    $this->assertDatabaseHas('fishes', $fishData);        
});

test('can create a verified fish', function () {
    $fishData = [
        'name' => 'Goldfish',
        'description' => fake()->text(),
        'lifespan' => fake()->numberBetween(0, 100),
        'length' => fake()->numberBetween(0,1000)
    ];

    $response = $this->post('/api/fishes', $fishData);

    $response->assertStatus(201);

    $this->assertDatabaseHas('fishes', array_merge($fishData, ['verified' => true]));        
});


