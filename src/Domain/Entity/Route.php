<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 22.03.17
 * Time: 21:31
 */

namespace TestApi\Domain\Entity;


use TestApi\Application\Exception\BrokenRouteChainException;
use TestApi\Application\Exception\InputDuplicatedBoardingCardException;

/**
 * Class Route
 *
 * @package TestApi\Domain\Entity
 */
class Route
{
    /**
     * @var array
     */
    private $route = [];

    /**
     * @var string
     */
    private $startPoint;

    /**
     * @param BoardingCardAbstract $card
     *
     * @throws InputDuplicatedBoardingCardException
     */
    public function addBoardingCard(BoardingCardAbstract $card)
    {
        if (isset($this->route[$card->getStartPoint()]['out'])) {
            throw new InputDuplicatedBoardingCardException();
        } else {
            $this->route[$card->getStartPoint()]['out'] = &$card;
        }
        if (isset($this->route[$card->getEndPoint()]['in'])) {
            throw new InputDuplicatedBoardingCardException();
        } else {
            $this->route[$card->getEndPoint()]['in'] = $card;
        }

        if (!isset($this->route[$card->getStartPoint()]['in'])) {
            $this->startPoint = $card->getStartPoint();
        }
    }

    /**
     * @return BoardingCardAbstract[]
     *
     * @throws BrokenRouteChainException
     */
    public function getRoute(): array
    {
        $routeList = [];
        $point = $this->startPoint;
        $card = $this->route[$this->startPoint]['out'];
        $routeList[] = $card;

        while (isset($this->route[$card->getEndPoint()]['out'])) {
            $card = $this->route[$card->getEndPoint()]['out'];
            $routeList[] = $card;
        }

        if (count($routeList) != count($this->route) - 1) {
            throw new BrokenRouteChainException();
        }

        return $routeList;
    }
}