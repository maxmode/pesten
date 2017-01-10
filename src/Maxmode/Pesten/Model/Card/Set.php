<?php
namespace Maxmode\Pesten\Model\Card;

use Maxmode\Pesten\Model\Card;

/**
 * Class Set is a storage for set of cards
 */
class Set
{
    /**
     * @var Card[]
     */
    private $cards;

    /**
     * Set constructor.
     *
     * @param Card[] $cards
     */
    public function __construct($cards = [])
    {
        $this->cards = $cards;
    }

    /**
     * @return Card[]
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * @param Card[] $cards
     */
    public function setCards($cards)
    {
        $this->cards = $cards;
    }

    /**
     * @return Card
     */
    public function shiftCard()
    {
        return array_shift($this->cards);
    }

    /**
     * @param Card $card
     */
    public function addCard(Card $card)
    {
        array_unshift($this->cards, $card);
    }

    /**
     * @param Card $card
     */
    public function removeCard(Card $card)
    {
        if (in_array($card, $this->cards)) {
            unset($this->cards[array_search($card, $this->cards)]);
        }
    }

    /**
     * @return bool
     */
    public function hasCards()
    {
        return count($this->cards) > 0;
    }
}
