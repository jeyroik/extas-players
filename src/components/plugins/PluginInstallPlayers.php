<?php
namespace extas\components\plugins;

use extas\interfaces\players\IPlayerRepository;
use extas\components\players\Player;

/**
 * Class PluginInstallPlayers
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallPlayers extends PluginInstallDefault
{
    protected string $selfSection = 'players';
    protected string $selfName = 'player';
    protected string $selfRepositoryClass = IPlayerRepository::class;
    protected string $selfUID = Player::FIELD__NAME;
    protected string $selfItemClass = Player::class;
}
