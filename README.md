![tests](https://github.com/jeyroik/extas-players/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-players/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>
<a href="https://codeclimate.com/github/jeyroik/extas-players/maintainability"><img src="https://api.codeclimate.com/v1/badges/08920d1c20f45b540a2c/maintainability" /></a>
<a href="https://github.com/jeyroik/extas-installer/" title="Extas Installer v3"><img alt="Extas Installer v3" src="https://img.shields.io/badge/installer-v3-green"></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-players/v)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-players/downloads)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Dependents](https://poser.pugx.org/jeyroik/extas-players/dependents)](//packagist.org/packages/jeyroik/extas-q-crawlers)

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