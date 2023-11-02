<?php

namespace App\Services;

use App\Entity\Ad;

class CreateRandom
{
    public function createFiveRandom(): array
    {
        $randOne = rand(1, 45);
        $randTwo = rand(1, 45);
        while($randOne == $randTwo)
        {
            $randTwo = rand(1, 45);
        }
        $randThree = rand(1, 45);
        while($randOne == $randThree || $randTwo == $randThree)
        {
            $randThree = rand(1, 45);
        }
        $randFour = rand(1, 45);
        while($randOne == $randFour || $randTwo == $randFour || $randThree == $randFour)
        {
            $randFour = rand(1, 45);
        }
        $randFive = rand(1, 45);
        while($randOne == $randFive || $randTwo == $randFive || $randThree == $randFive || $randFour == $randFive)
        {
            $randFive = rand(1, 45);
        }

        $random = [$randOne, $randTwo, $randThree, $randFour, $randFive];

        return $random;
    }
}