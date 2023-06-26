<?php
namespace extas\interfaces\stages\players;

use extas\interfaces\players\IPlayer;

interface IStagePlayerLogin
{
    public const NAME = 'extas.player.login';

    public function __invoke(IPlayer $player, bool &$loggedIn): void;
}
