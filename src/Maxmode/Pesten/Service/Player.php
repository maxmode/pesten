<?php
namespace Maxmode\Pesten\Service;

use Maxmode\Pesten\Model\Card as CardModel;
use Maxmode\Pesten\Model\Player as PlayerModel;

/**
 * Player service simulates user behaviour; can be used to ask user interactively
 */
class Player implements PlayerInterface
{
    /**
     * @param PlayerModel $player
     * @param CardModel[] $possibleCards
     *
     * @return CardModel
     */
    public function chooseCardToPlay(PlayerModel $player, $possibleCards)
    {
        return $possibleCards[mt_rand(0, count($possibleCards) - 1)];
    }
}
