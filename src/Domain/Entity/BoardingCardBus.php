<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 22.03.17
 * Time: 18:33
 */

namespace TestApi\Domain\Entity;

/**
 * Class BoardingCardBus
 *
 * @package TestApi\Domain\Entity
 */
class BoardingCardBus extends BoardingCardAbstract
{
    /**
     * @var string
     */
    private $busNumber;

    /**
     * BoardingCardBus constructor.
     *
     * @param string      $busNumber
     * @param string      $startPoint
     * @param string      $endPoint
     * @param string|null $seat
     */
    public function __construct(string $busNumber, string $startPoint, string $endPoint, string $seat = null)
    {
        parent::__construct($startPoint, $endPoint, $seat);
        $this->busNumber = $busNumber;
    }

    /**
     * @return string
     */
    public function getBusNumber(): string
    {
        return $this->busNumber;
    }
}