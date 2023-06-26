![tests](https://github.com/jeyroik/extas-players/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-players/coverage.svg?branch=master)
<a href="https://codeclimate.com/github/jeyroik/extas-players/maintainability"><img src="https://api.codeclimate.com/v1/badges/08920d1c20f45b540a2c/maintainability" /></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-players/v)](//packagist.org/packages/jeyroik/extas-players)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-players/downloads)](//packagist.org/packages/jeyroik/extas-players)
[![Dependents](https://poser.pugx.org/jeyroik/extas-players/dependents)](//packagist.org/packages/jeyroik/extas-players)

# Описание

Пакет предоставляет механизм для управления пользователями.

# Использование

Пакет состоит из

- `IPlayer` - Игрок, он же пользователь.
- `IPlayerIdentity` - Личность или учётная запись игрока. У одного игрока может быть несколько учётных записей.
- `IPlayerIdentityProvider` - Поставщик учётных записей.

Механизм работает следующим образом:

1. На вход поступает имя поставщика и текущее значение для учётной записи.
2. Если для данной пары "поставщик+значение учётной записи" есть Учётная запись, значит и пользователь существует.
3. Если учётной записи нет, то она создаётся.
3.1. Если в момент создания учётной записи есть залогиненный пользователь, то учётная запись привязывается к нему.

```php
use extas\components\players\PlayerService;

$currentPlayer = PlayerService::getCurrentPlayer();

$identity = //get user identity form outside service
$playerName = $currentPlayer ? $currentPlayer->getName() : $identity;

$player = null;
$playerIdentity = $playerIdentityService->getIdentityByValue($this->client->getId(), $identity);
if (!$playerIdentity) {
        $playerIdentity = $playerIdentityService->createIdentity($this->client->getProvider(), $playerName, $identity) ;
}      
$player = $currentPlayer ?: $playerIdentity->getPlayer();
$playerService->login($player);
```