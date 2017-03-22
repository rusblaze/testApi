<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 22.03.17
 * Time: 18:32
 */

namespace TestApi\Domain\Entity;

/**
 * Class BoardingCardFlight
 *
 * @package TestApi\Domain\Entity
 */
class BoardingCardFlight extends BoardingCardAbstract
{
    /**
     * @var string
     */
    private $flightNumber;
    /**
     * @var string
     */
    private $gate;

    /**
     * BoardingCardFlight constructor.
     *
     * @param string      $flightNumber
     * @param string      $gate
     * @param string      $startPoint
     * @param string      $endPoint
     * @param string|null $seat
     */
    public function __construct(
        string $flightNumber,
        string $gate,
        string $startPoint,
        string $endPoint,
        string $seat = null
    ) {
        parent::__construct($startPoint, $endPoint, $seat);
        $this->flightNumber = $flightNumber;
        $this->gate = $gate;
    }

    /**
     * @return string
     */
    public function getFlightNumber(): string
    {
        return $this->flightNumber;
    }

    /**
     * @return string
     */
    public function getGate(): string
    {
        return $this->gate;
    }
}