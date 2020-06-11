<?php
namespace extas\components\plugins\install;

use extas\components\players\Player;

/**
 * Class InstallPlayers
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallPlayers extends InstallSection
{
    protected string $selfSection = 'players';
    protected string $selfName = 'player';
    protected string $selfRepositoryClass = 'playerRepository';
    protected string $selfUID = Player::FIELD__NAME;
    protected string $selfItemClass = Player::class;
}
