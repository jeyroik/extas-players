<?php
namespace extas\interfaces\players;

use extas\interfaces\IHasId;
use extas\interfaces\IItem;

/**
 * Interface IPlayerIdentity
 *
 * @package extas\interfaces\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IPlayerIdentity extends IItem, IHasId
{
    public const SUBJECT = 'extas.player.identity';

    public const FIELD__SECRET = 'secret';
    public const FIELD__SOURCE = 'source';

    /**
     * @return mixed
     */
    public function getSecret();

    /**
     * @return mixed
     */
    public function getSource();

    /**
     * @param $secret
     *
     * @return $this
     */
    public function setSecret($secret);

    /**
     * @param $source
     *
     * @return $this
     */
    public function setSource($source);
}
