![tests](https://github.com/jeyroik/extas-players/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/extas-players/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a>
<a href="https://codeclimate.com/github/jeyroik/extas-players/maintainability"><img src="https://api.codeclimate.com/v1/badges/08920d1c20f45b540a2c/maintainability" /></a>
<a href="https://github.com/jeyroik/extas-installer/" title="Extas Installer v3"><img alt="Extas Installer v3" src="https://img.shields.io/badge/installer-v3-green"></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/extas-players/v)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Total Downloads](https://poser.pugx.org/jeyroik/extas-players/downloads)](//packagist.org/packages/jeyroik/extas-q-crawlers)
[![Dependents](https://poser.pugx.org/jeyroik/extas-players/dependents)](//packagist.org/packages/jeyroik/extas-q-crawlers)

# Описание

Пакет предоставляет механизм идентификации пользователя.

# Использование

Пакет поддерживает различный драйверы идентификации. 

Допустим, получен токен, необходимо по нему определить пользователя:

```php
use extas\interfaces\repositories\IRepository;
use extas\interfaces\players\identities\IPlayerToIdentityMap as IMap;
/**
 * @var string $token
 * @var IRepository $playersIdentitiesMaps
 */
$identityFactory = new \extas\components\players\identities\PlayerIdentityFactory();
$identity = $identityFactory->getIdentity('token', ['token' => $token]);

if ($identity) {
    $maps = $playersIdentitiesMaps->all([IMap::FIELD__PLAYER_IDENTITY => $identity->getName()]); 
    return array_shift($maps)->getPlayer();
}
```

Идентификация по логину и паролю:

```php
use extas\interfaces\repositories\IRepository;
use extas\interfaces\players\identities\IPlayerToIdentityMap as IMap;
/**
 * @var string $login
 * @var string $password
 * @var IRepository $playersIdentitiesMaps
 */
$identityFactory = new \extas\components\players\identities\PlayerIdentityFactory();
$identity = $identityFactory->getIdentity('login_password', [
    'login' => $login,
    'password' => $password
]);

if ($identity) {
    $maps = $playersIdentitiesMaps->all([IMap::FIELD__PLAYER_IDENTITY => $identity->getName()]); 
    return array_shift($maps)->getPlayer();
}
```