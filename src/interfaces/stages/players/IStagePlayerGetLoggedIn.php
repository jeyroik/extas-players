<?php
namespace extas\interfaces\stages\players;

use extas\interfaces\players\IPlayer;

interface IStagePlayerGetLoggedIn
{
    public const NAME = 'extas.player.get.logged.in';

    public function __invoke(?IPlayer &$player): void;
}
