<?php
namespace Maxmode\Pesten\Service;

use Maxmode\Pesten\Model\Game as GameModel;
use Maxmode\Pesten\Model\Card as CardModel;
use Maxmode\Pesten\Service\Game\LoggerInterface;

/**
 * Game service represents game rules
 */
class Game
{
    const CARDS_PER_PLAYER = 7;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var PlayerInterface
     */
    protected $playerService;

    /**
     * @param GameModel $game
     */
    public function dealtCards(GameModel $game)
    {
        // Create drawing stack
        $game->setDrawingStack($this->generateDeck());
        $this->mixCardSet($game->getDrawingStack());

        // Assign cards to players
        for ($i = 0; $i < static::CARDS_PER_PLAYER; $i++) {
            foreach ($game->getPlayers() as $player) {
                $player->getCardSet()->addCard($game->getDrawingStack()->shiftCard());
            }
        }
        $game->setTopCard($game->getDrawingStack()->shiftCard());
    }

    /**
     * @param GameModel $game
     */
    public function playGame(GameModel $game)
    {
        $this->logger->gameStart($game);
        $nothingChanged = 0;
        while ($nothingChanged < count($game->getPlayers())) {
            $nothingChanged = 0;
            foreach ($game->getPlayers() as $player) {
                $possibleMoves = $this->getCorrespondentCards($player->getCardSet(), $game->getTopCard());
                if ($possibleMoves) {
                    $game->setTopCard($this->playerService->chooseCardToPlay($player, $possibleMoves));
                    $player->getCardSet()->removeCard($game->getTopCard());
                    $this->logger->playerMove($game, $player, $game->getTopCard());
                    if (!$player->getCardSet()->hasCards()) {
                        $game->setWinner($player);
                        break 2;
                    }
                } elseif ($game->getDrawingStack()->hasCards()) {
                    $cardFromDeck = $game->getDrawingStack()->shiftCard();
                    $player->getCardSet()->addCard($cardFromDeck);
                    $this->logger->playerTakeCard($game, $player, $cardFromDeck);
                } else {
                    $nothingChanged++;
                }
            }
        }
        $this->logger->gameEnd($game);
    }

    /**
     * @param CardModel\Set $allCards
     * @param CardModel     $correspondentCard
     *
     * @return CardModel[]
     */
    public function getCorrespondentCards(CardModel\Set $allCards, CardModel $correspondentCard)
    {
        $correspondentCards = [];
        foreach ($allCards->getCards() as $card) {
            if ($card->getValue() == $correspondentCard->getValue()
                || $card->getSuit() == $correspondentCard->getSuit()) {
                $correspondentCards[] = $card;
            }
        }

        return $correspondentCards;
    }

    /**
     * @return CardModel\Set
     */
    public function generateDeck()
    {
        $cards = [];
        foreach (CardModel::getSuits() as $suit) {
            foreach (CardModel::getValues() as $value) {
                $cards[] = new CardModel($suit, $value);
            }
        }
        $deck = new CardModel\Set();
        $deck->setCards($cards);

        return $deck;
    }

    /**
     * @param CardModel\Set $cardSet
     */
    public function mixCardSet($cardSet)
    {
        $cards = $cardSet->getCards();
        shuffle($cards);
        $cardSet->setCards($cards);
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param PlayerInterface $playerService
     */
    public function setPlayerService($playerService)
    {
        $this->playerService = $playerService;
    }
}
