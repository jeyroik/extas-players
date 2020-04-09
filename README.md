![tests](https://github.com/jeyroik/extas-players/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-players/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>

# Описание

Модель пользователя.

# Установка

`composer require jeyroik/extas-players:2.*`

# Использование

## Термины

- `identity` - используется для хранения данных для идентификации пользователя.
- `setting` - используется для хранения настроек для пользователя.
- `alias` - используется для добавления пользователя в группу (для этого просто добавляется алиас группы).

## Создание пользователя

```php
use extas\components\players\Player;

/**
 * @var $playerRepo extas\interfaces\players\IPlayerRepository
 */
$player = new Player([
    Player::FIELD__NAME => 'jeyroik'
]);
$playerRepo->create($player);
```