<?php

it('should have 9 weapons in stock', function () {
    $user = new User;
    
    expect($user->getStockWeapons())->toHaveCount(9);
});
