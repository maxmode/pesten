<?php
namespace Maxmode\Pesten\Model;

/**
 * Card model represents single Card
 */
class Card
{
    const SUIT_SPADES = "\xE2\x99\xA0";
    const SUIT_HEARTS = "\xE2\x99\xA5";
    const SUIT_DIAMONDS = "\xE2\x99\xA6";
    const SUIT_CLUBS = "\xE2\x99\xA3";

    const VALUE_2 = '2';
    const VALUE_3 = '3';
    const VALUE_4 = '4';
    const VALUE_5 = '5';
    const VALUE_6 = '6';
    const VALUE_7 = '7';
    const VALUE_8 = '8';
    const VALUE_9 = '9';
    const VALUE_10 = '10';
    const VALUE_JACK = 'J';
    const VALUE_QUEEN = 'Q';
    const VALUE_KING = 'K';
    const VALUE_ACE = 'A';

    /**
     * @var string
     */
    private $suit;

    /**
     * @var string
     */
    private $value;

    /**
     * Card constructor.
     *
     * @param string $suit
     * @param string $value
     */
    public function __construct($suit, $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * @param string $suit
     */
    public function setSuit($suit)
    {
        $this->suit = $suit;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getSuit() . $this->getValue();
    }

    /**
     * @return array
     */
    public static function getSuits()
    {
        return [
            static::SUIT_SPADES,
            static::SUIT_HEARTS,
            static::SUIT_DIAMONDS,
            static::SUIT_CLUBS,
        ];
    }

    /**
     * @return array
     */
    public static function getValues()
    {
        return [
            static::VALUE_2,
            static::VALUE_3,
            static::VALUE_4,
            static::VALUE_5,
            static::VALUE_6,
            static::VALUE_7,
            static::VALUE_8,
            static::VALUE_9,
            static::VALUE_10,
            static::VALUE_JACK,
            static::VALUE_QUEEN,
            static::VALUE_KING,
            static::VALUE_ACE,
        ];
    }
}
