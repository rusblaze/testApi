<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 22.03.17
 * Time: 21:38
 */

namespace TestApi\Domain\Entity;

/**
 * Class BoardingCardAirportBus
 *
 * @package TestApi\Domain\Entity
 */
class BoardingCardAirportBus extends BoardingCardBus
{
    /**
     * @var string
     */
    private $airport;

    /**
     * BoardingCardAirportBus constructor.
     *
     * @param string      $airport
     * @param string      $busNumber
     * @param string      $startPoint
     * @param string      $endPoint
     * @param string|null $seat
     */
    public function __construct(
        string $airport,
        string $busNumber,
        string $startPoint,
        string $endPoint,
        string $seat = null
    ) {
        parent::__construct($busNumber, $startPoint, $endPoint, $seat);
        $this->airport = $airport;
    }

    /**
     * @return string
     */
    public function getAirport(): string
    {
        return $this->airport;
    }
}