<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 22.03.17
 * Time: 21:36
 */

namespace Test\TestApi\Application;


use PHPUnit\Framework\TestCase;
use TestApi\Application\Exception\BrokenRouteChainException;
use TestApi\Application\Exception\InputDuplicatedBoardingCardException;
use TestApi\Application\SortingService;
use TestApi\Domain\Entity\BoardingCardAirportBus;
use TestApi\Domain\Entity\BoardingCardBus;
use TestApi\Domain\Entity\BoardingCardFlight;
use TestApi\Domain\Entity\BoardingCardTrain;

class SortingServiceTest extends TestCase
{
    public function testSortHappyPath()
    {
        $stack = [
            new BoardingCardTrain('78A', 'Madrid', 'Barcelona', '45B'),
            new BoardingCardAirportBus('Gerona', '332', 'Barcelona', 'Gerona'),
            new BoardingCardFlight('SK455', '45B', 'Gerona', 'Stockholm', '3A'),
            new BoardingCardFlight('SK22', '22', 'Stockholm', 'New York JFK', '7B'),
        ];
        $sortingServie = new SortingService();
        $route = $sortingServie->sort($stack);

        $this->assertEquals('Madrid', $route[0]->getStartPoint());
        $this->assertEquals('Barcelona', $route[0]->getEndPoint());

        $this->assertEquals('Barcelona', $route[1]->getStartPoint());
        $this->assertEquals('Gerona', $route[1]->getEndPoint());

        $this->assertEquals('Gerona', $route[2]->getStartPoint());
        $this->assertEquals('Stockholm', $route[2]->getEndPoint());

        $this->assertEquals('Stockholm', $route[3]->getStartPoint());
        $this->assertEquals('New York JFK', $route[3]->getEndPoint());
    }

    public function testSortHappyPathUnsortedInput()
    {
        $stack = [
            new BoardingCardFlight('SK22', '22', 'Stockholm', 'New York JFK', '7B'),
            new BoardingCardFlight('SK455', '45B', 'Gerona', 'Stockholm', '3A'),
            new BoardingCardAirportBus('Gerona', '332', 'Barcelona', 'Gerona'),
            new BoardingCardTrain('78A', 'Madrid', 'Barcelona', '45B'),
        ];
        $sortingServie = new SortingService();
        $route = $sortingServie->sort($stack);

        $this->assertEquals('Madrid', $route[0]->getStartPoint());
        $this->assertEquals('Barcelona', $route[0]->getEndPoint());

        $this->assertEquals('Barcelona', $route[1]->getStartPoint());
        $this->assertEquals('Gerona', $route[1]->getEndPoint());

        $this->assertEquals('Gerona', $route[2]->getStartPoint());
        $this->assertEquals('Stockholm', $route[2]->getEndPoint());

        $this->assertEquals('Stockholm', $route[3]->getStartPoint());
        $this->assertEquals('New York JFK', $route[3]->getEndPoint());
    }

    public function testSortDuplicatedInput()
    {
        $stack = [
            new BoardingCardFlight('SK22', '22', 'Stockholm', 'New York JFK', '7B'),
            new BoardingCardFlight('SK455', '45B', 'Gerona', 'Stockholm', '3A'),
            new BoardingCardFlight('SK455', '45B', 'Gerona', 'Stockholm', '3A'),
            new BoardingCardAirportBus('Gerona', '332', 'Barcelona', 'Gerona'),
            new BoardingCardTrain('78A', 'Madrid', 'Barcelona', '45B'),
        ];
        $sortingServie = new SortingService();
        $this->expectException(InputDuplicatedBoardingCardException::class);
        $sortingServie->sort($stack);
    }

    public function testWrongInput()
    {
        $stack = [
            1, 'sfsdfsdf'
        ];
        $sortingServie = new SortingService();
        $this->expectException(\TypeError::class);
        $sortingServie->sort($stack);
    }

    public function testBrokenRouteChain()
    {
        $stack = [
            new BoardingCardFlight('SK22', '22', 'Stockholm', 'New York JFK', '7B'),
            new BoardingCardAirportBus('Gerona', '332', 'Barcelona', 'Gerona'),
            new BoardingCardTrain('78A', 'Madrid', 'Barcelona', '45B'),
        ];
        $sortingServie = new SortingService();
        $this->expectException(BrokenRouteChainException::class);
        $sortingServie->sort($stack);
    }

    public function testPrint()
    {
        $boardingCards = [
            new BoardingCardAirportBus('Gerona', '332', 'Barcelona', 'Gerona'),
            new BoardingCardTrain('78A', 'Madrid', 'Barcelona', '45B'),
        ];

        $sortingServie = new SortingService();
        $route = $sortingServie->sort(
            $boardingCards
        );

        print_r($route);die;
    }
}