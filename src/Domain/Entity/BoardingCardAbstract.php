<?php
/**
 * Created by PhpStorm.
 * User: aivanov
 * Date: 22.03.17
 * Time: 18:29
 */

namespace TestApi\Domain\Entity;

/**
 * Class BoardingCardAbstract
 *
 * @package TestApi\Domain\Entity
 */
abstract class BoardingCardAbstract
{
    /**
     * @var null
     */
    private $seat = null;
    /**
     * @var string
     */
    private $startPoint;
    /**
     * @var string
     */
    private $endPoint;

    /**
     * BoardingCardAbstract constructor.
     *
     * @param string      $startPoint
     * @param string      $endPoint
     * @param string|null $seat
     */
    public function __construct(string $startPoint, string $endPoint, string $seat = null)
    {
        $this->startPoint = $startPoint;
        $this->endPoint = $endPoint;
        $this->seat = $seat;
    }

    /**
     * @return string|null
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @return string
     */
    public function getStartPoint(): string
    {
        return $this->startPoint;
    }

    /**
     * @return string
     */
    public function getEndPoint(): string
    {
        return $this->endPoint;
    }
}