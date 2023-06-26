<?php
namespace extas\components\plugins\players;

use extas\components\plugins\Plugin;
use extas\interfaces\players\IPlayer;
use extas\interfaces\repositories\IRepository;
use extas\interfaces\stages\players\IStagePlayerGetLoggedIn;

/**
 * {
 *  "class": "\\extas\\components\\plugins\\players\\PluginPlayerGetLoggedInByCookie",
 *  "stage": "extas.player.get.logged.in",
 *  "parameters": {
 *      "cookie": {"name": "cookie", "value": "my_field_name"},// default is "extas__player"
 *      "expiration": {"name": "expiration", "value": 86400},  // default 2592000 (30 hours)
 *  }
 * }
 * 
 * Please, make sure `cookie` and `expiration` are the same as in PluginPlayerLoginByCookie or analogue.
 * 
 * @method IRepository players()
 */
class PluginPlayerGetLoggedInByCookie extends Plugin implements IStagePlayerGetLoggedIn
{
    public const PARAM__COOKIE = 'cookie';
    public const COOKIE__DEFAULT = 'extas__player';

    public const PARAM__EXPIRATION = 'expiration';
    public const EXPIRATION__DEFAULT = 2592000;

    public const PARAM__COOKIE_PATH = 'cookie_path';
    public const COOKIE_PATH__DEFAULT = '/tmp/.cookie';

    public function __invoke(?IPlayer &$player): void
    {
        if (!$player) {
            $fieldName  = $this->getParameterValue(static::PARAM__COOKIE, static::COOKIE__DEFAULT);
            $period     = $this->getParameterValue(static::PARAM__EXPIRATION, static::EXPIRATION__DEFAULT);

            $data = explode('#!', $this->getCookie($fieldName));
            list($hash, $name) = count($data) == 2 ? $data : ['',''];

            if (sha1($name . $period) == $hash) {
                $player = $this->players()->one([IPlayer::FIELD__NAME => $name]);
            }
        }
    }

    protected function getCookie($fieldName): string
    {
        if (PHP_SAPI == 'cli') {
            $path = $this->getParameterValue(static::PARAM__COOKIE_PATH, static::COOKIE_PATH__DEFAULT);
            list($cookieName, $value) = is_file($path) ? json_decode(file_get_contents($path), true) : ['', ''];
            if ($cookieName == $fieldName) {
                return $value;
            }
        } else {
            if (isset($_COOKIE[$fieldName])) {
                return $_COOKIE[$fieldName];
            }
        }

        return '#!';
    }
}
