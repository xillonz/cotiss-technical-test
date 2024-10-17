<?php

use App\Models\Fishes;

test('fish with appropriate name gets verified', function () {
    $fish = new Fishes();

    $fish->name = 'Goldfish';

    $fish->verifyFish();

    expect($fish->verified)->toBeTrue();
});

test('fish with inappropriate name do not get verified', function () {
    $fish = new Fishes();

    $fish->name = 'Test';

    $fish->verifyFish();

    expect($fish->verified)->toBeFalse();
});

