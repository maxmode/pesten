<?php
namespace Maxmode\Pesten\Tests\Service;

use Maxmode\Pesten\Model\Card;
use Maxmode\Pesten\Model\Game as Game;
use Maxmode\Pesten\Model\Player as Player;
use Maxmode\Pesten\Service\PlayerInterface;
use Maxmode\Pesten\Service\Game\LoggerInterface;
use Maxmode\Pesten\Service\Game as GameService;

/**
 * Test for Maxmode\Pesten\Service\Game
 */
class GameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GameService
     */
    protected $service;

    /**
     * @var LoggerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $loggerService;

    /**
     * @var PlayerInterface | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $playerService;

    protected function setUp()
    {
        $this->loggerService = $this->getMockBuilder(LoggerInterface::class)->getMockForAbstractClass();
        $this->playerService = $this->getMockBuilder(PlayerInterface::class)->getMockForAbstractClass();

        $this->service = new GameService();
        $this->service->setPlayerService($this->playerService);
        $this->service->setLogger($this->loggerService);
    }

    /**
     * Test for Maxmode\Pesten\Service\Game::generateDeck
     */
    public function testGenerateDeckSet()
    {
        $deck = $this->service->generateDeck();
        $this->assertCount(52, $deck->getCards());
    }

    /**
     * Test for Maxmode\Pesten\Service\Game::mixCardSet
     */
    public function testMixCards()
    {
        $deck = $this->service->generateDeck();
        $initialCards = $deck->getCards();
        $this->service->mixCardSet($deck);
        $mixedCards = $deck->getCards();
        $this->assertCount(52, $mixedCards);
        $this->assertNotEquals($initialCards, $mixedCards);
    }

    /**
     * Test for Maxmode\Pesten\Service\Game::dealtCards
     */
    public function testDealtCards()
    {
        $game = new Game();
        $game->setPlayers([
            new Player('Alice'),
            new Player('Bob'),
            new Player('Carol'),
            new Player('Eve'),
        ]);
        $this->service->dealtCards($game);

        $this->assertCount(4, $game->getPlayers());
        $this->assertNotEmpty($game->getTopCard());
        $this->assertCount(23, $game->getDrawingStack()->getCards());
        foreach ($game->getPlayers() as $player) {
            $this->assertCount(7, $player->getCardSet()->getCards());
        }
    }

    /**
     * Test for Maxmode\Pesten\Service\Game::getCorrespondentCards
     */
    public function testGetCorrespondentCards()
    {
        $deck = new Card\Set([
            new Card(Card::SUIT_CLUBS, Card::VALUE_3),
            new Card(Card::SUIT_CLUBS, Card::VALUE_4),
            new Card(Card::SUIT_DIAMONDS, Card::VALUE_5),
        ]);
        $topCard = new Card(Card::SUIT_DIAMONDS, Card::VALUE_3);

        $correspondentCards = $this->service->getCorrespondentCards($deck, $topCard);

        $this->assertCount(2, $correspondentCards);
    }

    /**
     * Test for Maxmode\Pesten\Service\Game::playGame
     *
     * @param Game   $game
     * @param Player $expectedWinner
     *
     * @dataProvider playGameDataProvider
     */
    public function testPlayGame($game, $expectedWinner)
    {
        $this->playerService->expects($this->any())->method('chooseCardToPlay')->willReturnCallback(
            function ($player, $possibleMoves) {
                return current($possibleMoves);
            }
        );
        ob_start();
        $this->service->playGame($game);
        $this->assertEquals($expectedWinner, $game->getWinner());
        ob_end_clean();
    }

    /**
     * @return array
     */
    public function playGameDataProvider()
    {
        $players = [
            new Player('Alice', [new Card(Card::SUIT_CLUBS, Card::VALUE_3)]),
            new Player('Bob', [new Card(Card::SUIT_CLUBS, Card::VALUE_4)]),
            new Player('Carol', [new Card(Card::SUIT_CLUBS, Card::VALUE_5)]),
            new Player('Eve', [new Card(Card::SUIT_CLUBS, Card::VALUE_6)]),
        ];

        $game = new Game();
        $game->setPlayers($players);
        $game->setTopCard(new Card(Card::SUIT_DIAMONDS, Card::VALUE_5));
        $game->setDrawingStack(new Card\Set([
            new Card(Card::SUIT_HEARTS, Card::VALUE_10),
            new Card(Card::SUIT_SPADES, Card::VALUE_9),
            new Card(Card::SUIT_SPADES, Card::VALUE_5)
        ]));
        $gameNoWinner = clone $game;
        $gameNoWinner->setTopCard(new Card(Card::SUIT_DIAMONDS, Card::VALUE_KING));

        return [
            'case Carol winner' => [
                'game' => $game,
                'expectedWinner' => $players[2],
            ],
            'case no winner' => [
                'game' => $gameNoWinner,
                'expectedWinner' => null,
            ],
        ];
    }
}
