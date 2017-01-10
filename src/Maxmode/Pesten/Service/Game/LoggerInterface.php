<?php
namespace Maxmode\Pesten\Service\Game;

use Maxmode\Pesten\Model\Game;
use Maxmode\Pesten\Model\Player;
use Maxmode\Pesten\Model\Card;

/**
 * LoggerInterface allows to build observer to notify about changes in the game.
 */
interface LoggerInterface
{
    /**
     * @param Game $game
     */
    public function gameStart($game);

    /**
     * @param Game $game
     */
    public function gameEnd($game);

    /**
     * @param Game        $game
     * @param Player|null $player
     * @param Card|null   $card
     */
    public function playerMove($game, $player, $card);

    /**
     * @param Game        $game
     * @param Player|null $player
     * @param Card|null   $card
     */
    public function playerTakeCard($game, $player, $card);
}
