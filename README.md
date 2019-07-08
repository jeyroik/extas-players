# players

Пакет содержит функционал пользователей.

# Установка

`composer require jeyroik/extas-players:*`

# Использование

## Создание пользователя

```php
use extas\components\players\PlayerIdentity;
use extas\components\players\Player;

/**
 * @var $playerRepo extas\interfaces\players\IPlayerRepository
 */

$identity = new PlayerIdentity([
    PlayerIdentity::FIELD__ID => 'jeyroik',
    PlayerIdentity::FIELD__SECRET => sha1('jeyroik')
]);

$player = new Player([
    Player::FIELD__NAME => 'jeyroik'
]);
$player->addIdentity($identity);
$playerRepo->create($player);
```

## Сравнение пароля

```php
/**
 * @var $playerRepo extas\interfaces\players\IPlayerRepository
 * @var $player extas\components\players\Player
 */
 
$player = $playerRepo->one([IPlayer::FIELD__NAME => 'jeyroik']);
if ($player) {
    if ($player->getIdentity('jeyroik')->getSecret() == sha1('jeyroik')) {
        echo 'Пароль верный';
    }
}
```
