<?php
namespace extas\interfaces\players;

/**
 * Interface IHasOwner
 *
 * @package extas\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasOwner
{
    public const FIELD__OWNER = 'owner';

    /**
     * @return string
     */
    public function getOwnerName(): string;

    /**
     * @return IPlayer|null
     */
    public function getOwner(): ?IPlayer;

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setOwnerName(string $name);

    /**
     * @param IPlayer $player
     *
     * @return $this
     */
    public function setOwner(IPlayer $player);
}
