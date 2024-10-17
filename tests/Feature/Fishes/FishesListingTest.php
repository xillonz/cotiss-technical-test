<?php

use App\Models\Fishes;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can retrieve paginated fishes', function () {
    $fishes = Fishes::factory()->createMany(10);
    $paginationLimit = 5;

    $response = $this->get('/api/fishes');

    $expectedFishData = [];

    $i = 0;

    foreach ($fishes as $fish) {
        $i++;
        if ($i > $paginationLimit)
            break;

        $expectedFishData[] = [
            'id' => $fish->id,
            'name' => $fish->name,
            'lifespan' => $fish->lifespan,
            'length' => $fish->length,
            'verified' => $fish->verified
        ];
    }

    $response
        ->assertStatus(200)
        ->assertJson([
            'data' => $expectedFishData,
            'links' => [
                'first' => 'http://localhost:8000/api/fishes?page=1',
                'last' => 'http://localhost:8000/api/fishes?page=2',
                'prev' => null,
                'next' => 'http://localhost:8000/api/fishes?page=2'
            ],
            'meta' => [
                'current_page' => 1,
                'from' => 1,
                'last_page' => 2,
                'links' => [
                    [
                        'url' => null,
                        'label' => '&laquo; Previous',
                        'active' => false
                    ],
                    [
                        'url' => 'http://localhost:8000/api/fishes?page=1',
                        'label' => '1',
                        'active' => true
                    ],
                    [
                        'url' => 'http://localhost:8000/api/fishes?page=2',
                        'label' => '2',
                        'active' => false
                    ],
                    [
                        'url' => 'http://localhost:8000/api/fishes?page=2',
                        'label' => 'Next &raquo;',
                        'active' => false
                    ]
                ],
                'path' => 'http://localhost:8000/api/fishes',
                'per_page' => 5,
                'to' => 5,
                'total' => 10
            ]
        ]);
});

test('can retrieve additional pages of fishes', function () {
    $fishes = Fishes::factory()->createMany(10);
    $paginationLimit = 5;

    $response = $this->get('/api/fishes?page=2');

    $expectedFishData = [];

    $i = 0;

    foreach ($fishes as $fish) {
        $i++;
        if ($i <= $paginationLimit)
            continue;

        $expectedFishData[] = [
            'id' => $fish->id,
            'name' => $fish->name,
            'lifespan' => $fish->lifespan,
            'length' => $fish->length,
            'verified' => $fish->verified
        ];
    }

    $response
        ->assertStatus(200)
        ->assertJson([
            'data' => $expectedFishData,
            'links' => [
                'first' => 'http://localhost:8000/api/fishes?page=1',
                'last' => 'http://localhost:8000/api/fishes?page=2',
                'prev' => 'http://localhost:8000/api/fishes?page=1',
                'next' => null
            ],
            'meta' => [
                'current_page' => 2,
                'from' => 6,
                'last_page' => 2,
                'links' => [
                    [
                        'url' => 'http://localhost:8000/api/fishes?page=1',
                        'label' => '&laquo; Previous',
                        'active' => false
                    ],
                    [
                        'url' => 'http://localhost:8000/api/fishes?page=1',
                        'label' => '1',
                        'active' => false
                    ],
                    [
                        'url' => 'http://localhost:8000/api/fishes?page=2',
                        'label' => '2',
                        'active' => true
                    ],
                    [
                        'url' => null,
                        'label' => 'Next &raquo;',
                        'active' => false
                    ]
                ],
                'path' => 'http://localhost:8000/api/fishes',
                'per_page' => 5,
                'to' => 10,
                'total' => 10
            ]
        ]);
});

