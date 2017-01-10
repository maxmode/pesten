<?php
namespace Maxmode\Pesten\Model;

use Maxmode\Pesten\Model\Card\Set;

/**
 * Game model represents state of the game
 */
class Game
{
    /**
     * @var Player[]
     */
    private $players = [];

    /**
     * @var Player
     */
    private $winner;

    /**
     * @var Set
     */
    private $drawingStack;

    /**
     * @var Card
     */
    private $topCard;

    /**
     * @return Player[]
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param Player[] $players
     */
    public function setPlayers($players)
    {
        $this->players = $players;
    }

    /**
     * @return Player
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @param Player $winner
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
    }

    /**
     * @return Set
     */
    public function getDrawingStack()
    {
        return $this->drawingStack;
    }

    /**
     * @param Set $drawingStack
     */
    public function setDrawingStack($drawingStack)
    {
        $this->drawingStack = $drawingStack;
    }

    /**
     * @return Card
     */
    public function getTopCard()
    {
        return $this->topCard;
    }

    /**
     * @param Card $topCard
     */
    public function setTopCard($topCard)
    {
        $this->topCard = $topCard;
    }
}
