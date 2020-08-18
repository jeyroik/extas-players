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
/**
 * @var string $token
 */
$identityFactory = new \extas\components\players\identities\PlayerIdentityFactory();
$identity = $identityFactory->getIdentity('token', ['token' => $token]);

if ($identity) {
    return $identity->getPlayer();
}
```

Идентификация по логину и паролю:

```php
/**
 * @var string $login
 * @var string $password
 */
$identityFactory = new \extas\components\players\identities\PlayerIdentityFactory();
$identity = $identityFactory->getIdentity('login_password', [
    'login' => $login,
    'password' => $password
]);

if ($identity) {
    return $identity->getPlayer();
}
```