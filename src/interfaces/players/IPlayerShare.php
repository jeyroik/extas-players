<?php
namespace extas\interfaces\players;

use extas\interfaces\IItem;

/**
 * Interface IPlayerShare
 *
 * @package extas\interfaces\players
 * @author jeyroik@gmail.com
 */
interface IPlayerShare extends IItem
{
    const SUBJECT = 'extas.player.share';

    const FIELD__PLAYER = 'player';

    /**
     * @param callable $itemWorker
     * @param null|IPlayer $player can be missed if was passed through the constructor
     *
     * @return array
     */
    public function getShareTo($itemWorker, $player = null): array;

    /**
     * @param null|IPlayer $player can be missed if was passed through the constructor
     *
     * @return array
     */
    public function getShareOperations($player = null): array;

    /**
     * @return IPlayer
     */
    public function getPlayer(): IPlayer;

    /**
     * @param IPlayer $player
     *
     * @return $this
     */
    public function setPlayer(IPlayer $player);
}
