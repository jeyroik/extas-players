<?php
namespace extas\interfaces\players;

use extas\interfaces\IItem;

interface IPlayerService extends IItem
{
    public const SUBJECT = 'extas.player.service';

    public const PARAM__TOKEN = 'token';

    public function getLoggedIn(): ?IPlayer;

    public function login(IPlayer $player): bool;

    public function logout(IPlayer $player): bool;

    public function generateToken(IPlayer $player): IPlayer;
}
