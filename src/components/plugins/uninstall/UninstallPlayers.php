<?php
namespace extas\components\plugins\uninstall;

use extas\components\players\Player;

/**
 * Class UninstallPlayers
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik@gmail.com
 */
class UninstallPlayers extends UninstallSection
{
    protected string $selfSection = 'players';
    protected string $selfName = 'player';
    protected string $selfRepositoryClass = 'playerRepository';
    protected string $selfUID = Player::FIELD__NAME;
    protected string $selfItemClass = Player::class;
}
