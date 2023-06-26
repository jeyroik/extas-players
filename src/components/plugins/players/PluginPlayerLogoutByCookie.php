<?php
namespace extas\components\plugins\players;

use extas\components\plugins\Plugin;
use extas\interfaces\players\IPlayer;
use extas\interfaces\stages\players\IStagePlayerLogout;

/**
 * {
 *  "class": "\\extas\\components\\plugins\\players\\PluginPlayerLogoutByCookie",
 *  "stage": "extas.player.logout",
 *  "parameters": {
 *      "cookie": {"name": "cookie", "value": "my_field_name"},// default is "extas__player"
 *      "host": {"name": "host", "value": "/"}                 // default "/"
 *  }
 * }
 */
class PluginPlayerLogoutByCookie extends Plugin implements IStagePlayerLogout
{
    public const PARAM__COOKIE = 'cookie';
    public const COOKIE__DEFAULT = 'extas__player';
    
    public const PARAM__HOST = 'host';
    public const HOST__DEFAULT = '/';

    public const PARAM__COOKIE_PATH = 'cookie_path';
    public const COOKIE_PATH__DEFAULT = '/tmp/.cookie';

    public function __invoke(IPlayer $player, bool &$loggedOut): void
    {
        $fieldName  = $this->getParameterValue(static::PARAM__COOKIE, static::COOKIE__DEFAULT);
        $host       = $this->getParameterValue(static::PARAM__HOST, static::HOST__DEFAULT);

        if (PHP_SAPI == 'cli') {
            $path = $this->getParameterValue(static::PARAM__COOKIE_PATH, static::COOKIE_PATH__DEFAULT);
            if (is_file($path)) {
                unlink($path);
                $loggedOut = true;
            }
        } elseif (isset($_COOKIE[$fieldName])) {
            setcookie($fieldName, '', time() + 2, $host);
            unset($_COOKIE[$fieldName]);
            $loggedOut = true;
        }
    }
}
