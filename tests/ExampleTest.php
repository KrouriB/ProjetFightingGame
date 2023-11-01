<?php

use App\Entity\User;

it('should have 9 weapons in stock', function () {
    $user = new User;

    // dd($user);
    
    expect($user->getStockWeapons())->toHaveCount(9);
});

it('should have 5 perso in stock', function () {
    $user = new User;
    
    expect($user->getStockPersonnages())->toHaveCount(5);
});