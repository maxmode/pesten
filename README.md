Pesten game
===========
## Stability

[![Build Status](https://travis-ci.org/maxmode/pesten.png)](https://travis-ci.org/maxmode/pesten)

## About
This is a demo project of Pesten game.


## Requirements

1. PHP 5.6+
2. composer

## Installation

```
composer install
```

## Run tests

```
bin/phpunit
```

## Example of usage

Demo execution:
```
php cli.php
```

To use this game as an interactive application - implement following interfaces:
```php
use Maxmode\Pesten\Service\PlayerInterface;
use Maxmode\Pesten\Service\Game\LoggerInterface;
```

Example code of front controller:
```php
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
```