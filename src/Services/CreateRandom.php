<?php

namespace App\Services;

use App\Entity\Ad;

class CreateRandom
{
    public function createFiveRandom(): array
    {
        $randOne = rand(0, 44);
        $randTwo = rand(0, 44);
        while($randOne == $randTwo)
        {
            $randTwo = rand(0, 44);
        }
        $randThree = rand(0, 44);
        while($randOne == $randThree || $randTwo == $randThree)
        {
            $randThree = rand(0, 44);
        }
        $randFour = rand(0, 44);
        while($randOne == $randFour || $randTwo == $randFour || $randThree == $randFour)
        {
            $randFour = rand(0, 44);
        }
        $randFive = rand(0, 44);
        while($randOne == $randFive || $randTwo == $randFive || $randThree == $randFive || $randFour == $randFive)
        {
            $randFive = rand(0, 44);
        }

        $random = [$randOne, $randTwo, $randThree, $randFour, $randFive];

        return $random;
    }

    // method used to have a random index for an array
    public function createSingleRandom(int $lenght): int
    {
        if($lenght == 1)
        {
            return 0;
        }
        else
        {
            return rand(0, $lenght-1);
        }
    }
}