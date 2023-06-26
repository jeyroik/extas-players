<?php
namespace extas\components\plugins\players;

use extas\components\plugins\Plugin;
use extas\interfaces\players\IPlayer;
use extas\interfaces\stages\players\IStagePlayerLogin;

/**
 * {
 *  "class": "\\extas\\components\\plugins\\players\\PluginPlayerLoginByCookie",
 *  "stage": "extas.player.login",
 *  "parameters": {
 *      "cookie": {"name": "cookie", "value": "my_field_name"},// default is "extas__player"
 *      "expiration": {"name": "expiration", "value": 86400},  // default 2592000 (30 hours)
 *      "host": {"name": "host", "value": "/"}                 // default "/"
 *  }
 * }
 */
class PluginPlayerLoginByCookie extends Plugin implements IStagePlayerLogin
{
    public const PARAM__COOKIE = 'cookie';
    public const COOKIE__DEFAULT = 'extas__player';

    public const PARAM__EXPIRATION = 'expiration';
    public const EXPIRATION__DEFAULT = 2592000;
    
    public const PARAM__HOST = 'host';
    public const HOST__DEFAULT = '/';

    public const PARAM__COOKIE_PATH = 'cookie_path';
    public const COOKIE_PATH__DEFAULT = '/tmp/.cookie';

    public function __invoke(IPlayer $player, bool &$loggedIn): void
    {
        $name = $player->getName();

        $fieldName  = $this->getParameterValue(static::PARAM__COOKIE, static::COOKIE__DEFAULT);
        $period     = $this->getParameterValue(static::PARAM__EXPIRATION, static::EXPIRATION__DEFAULT);
        $host       = $this->getParameterValue(static::PARAM__HOST, static::HOST__DEFAULT);

        if (PHP_SAPI == 'cli') {
            $path = $this->getParameterValue(static::PARAM__COOKIE_PATH, static::COOKIE_PATH__DEFAULT);
            file_put_contents($path, json_encode([
                $fieldName,
                sha1($name . $period) . '#!' . $name,
                time() + $period,
                $host
            ]));
        } else {
            setcookie(
                $fieldName,
                sha1($name . $period) . '#!' . $name,
                time() + $period,
                $host
            );
        }

        $loggedIn = true;
    }
}
