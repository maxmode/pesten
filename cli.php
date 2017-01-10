<?php
use Maxmode\Pesten\Model\Game;
use Maxmode\Pesten\Model\Player;

include __DIR__ . '/vendor/autoload.php';

$game = new Game();
$game->setPlayers([
    new Player('Alice'),
    new Player('Bob'),
    new Player('Carol'),
    new Player('Eve'),
]);

$gameService = new \Maxmode\Pesten\Service\Game();
$gameService->setLogger(new \Maxmode\Pesten\Service\Game\Logger());
$gameService->setPlayerService(new \Maxmode\Pesten\Service\Player());

$gameService->dealtCards($game);
$gameService->playGame($game);
