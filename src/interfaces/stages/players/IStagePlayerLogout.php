<?php
namespace extas\interfaces\stages\players;

use extas\interfaces\players\IPlayer;

interface IStagePlayerLogout
{
    public const NAME = 'extas.player.logout';

    public function __invoke(IPlayer $player, bool &$loggedOut): void;
}
