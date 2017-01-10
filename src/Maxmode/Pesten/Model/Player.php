<?php
namespace Maxmode\Pesten\Model;

use Maxmode\Pesten\Model\Card\Set;

/**
 * Player Model represents state of single player
 */
class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Set
     */
    private $cardSet;

    /**
     * Player constructor.
     *
     * @param string $name
     * @param Card[] $cards
     */
    public function __construct($name, $cards = [])
    {
        $this->name = $name;
        $this->setCardSet(new Set($cards));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Set
     */
    public function getCardSet()
    {
        return $this->cardSet;
    }

    /**
     * @param Set $cardSet
     */
    public function setCardSet($cardSet)
    {
        $this->cardSet = $cardSet;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
