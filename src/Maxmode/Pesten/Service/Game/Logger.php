<?php
namespace Maxmode\Pesten\Service\Game;

use Maxmode\Pesten\Model\Game;
use Maxmode\Pesten\Model\Player;
use Maxmode\Pesten\Model\Card;

/**
 * Class Logger
 */
class Logger implements LoggerInterface
{
    /**
     * @param Game $game
     */
    public function gameStart($game)
    {
        $this->logString('Starting game with ' . implode(', ', $game->getPlayers()));
        foreach ($game->getPlayers() as $player) {
            $this->logString($player . ' has been dealt: ' . implode(',', $player->getCardSet()->getCards()));
        }
        $this->logString('Top card is ' . $game->getTopCard());
    }

    /**
     * @param Game $game
     */
    public function gameEnd($game)
    {
        if ($game->getWinner()) {
            $this->logString($game->getWinner() . ' has won');
        } else {
            $this->logString('Game ended. Drawing stack empty, no moves available');
        }
    }

    /**
     * @param Game        $game
     * @param Player|null $player
     * @param Card|null   $card
     */
    public function playerMove($game, $player, $card)
    {
        $this->logString($player . ' plays ' . $card);
    }

    /**
     * @param Game        $game
     * @param Player|null $player
     * @param Card|null   $card
     */
    public function playerTakeCard($game, $player, $card)
    {
        $this->logString($player . ' does not have a suitable card, taking from deck ' . $card);
    }

    /**
     * @param string $message
     */
    protected function logString($message)
    {
        echo '[' . date('H:i:s') . '] ' . $message . "\n";
    }
}
