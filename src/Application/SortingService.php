<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 22.03.17
 * Time: 21:33
 */

namespace TestApi\Application;


use TestApi\Domain\Entity\BoardingCardAbstract;
use TestApi\Domain\Entity\Route;

class SortingService
{
    /**
     * @param BoardingCardAbstract[] $boardingCards
     *
     * @return BoardingCardAbstract[]
     */
    public function sort(array $boardingCards): array
    {
        $route = new Route();
        foreach ($boardingCards as $boardingCard) {
            $route->addBoardingCard($boardingCard);
        }

        return $route->getRoute();
    }
}