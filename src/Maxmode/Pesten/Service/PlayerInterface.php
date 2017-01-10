<?php
namespace Maxmode\Pesten\Service;

use Maxmode\Pesten\Model\Card as CardModel;
use Maxmode\Pesten\Model\Player as PlayerModel;

/**
 * PlayerInterface simulates user behaviour; can be used to ask user interactively
 */
interface PlayerInterface
{
    /**
     * @param PlayerModel $player
     * @param CardModel[] $possibleCards
     *
     * @return CardModel
     */
    public function chooseCardToPlay(PlayerModel $player, $possibleCards);
}
