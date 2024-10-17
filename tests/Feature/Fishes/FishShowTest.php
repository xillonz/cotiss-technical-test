<?php

use App\Models\Fishes;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can show a fish', function () {
    $fish = Fishes::factory()->create();

    $response = $this->get("/api/fishes/$fish->id");

    $response->assertStatus(200)->assertJson(['data' => [
        'id'=> $fish->id,
        'name' => $fish->name,        
        'image_url' => $fish->image_url,
        'description' => $fish->description,
        'lifespan'=> $fish->lifespan,
        'length'=> $fish->length,
        'verified' => $fish->verified,
        'updated_at' => $fish->updated_at->format('Y-m-d H:i:s'),
        'created_at' => $fish->created_at->format('Y-m-d H:i:s')
    ]]);     
});


