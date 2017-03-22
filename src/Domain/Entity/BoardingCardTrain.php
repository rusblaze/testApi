<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 22.03.17
 * Time: 18:33
 */

namespace TestApi\Domain\Entity;


/**
 * Class BoardingCardTrain
 *
 * @package TestApi\Domain\Entity
 */
class BoardingCardTrain extends BoardingCardAbstract
{
    /**
     * @var string
     */
    private $trainNumber;

    /**
     * BoardingCardTrain constructor.
     *
     * @param string      $trainNumber
     * @param string      $startPoint
     * @param string      $endPoint
     * @param string|null $seat
     */
    public function __construct($trainNumber, string $startPoint, string $endPoint, string $seat = null)
    {
        parent::__construct($startPoint, $endPoint, $seat);
        $this->trainNumber = $trainNumber;
    }

    /**
     * @return string
     */
    public function getTrainNumber(): string
    {
        return $this->trainNumber;
    }
}