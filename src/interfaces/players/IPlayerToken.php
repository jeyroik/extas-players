<?php
namespace extas\interfaces\players;

use extas\interfaces\IItem;

/**
 * Interface IPlayerToken
 *
 * @package extas\interfaces\players
 * @author jeyroiK@gmail.com
 */
interface IPlayerToken extends IItem
{
    public const SUBJECT = 'extas.player.token';
    public const FIELD__SUBJECT = 'subject';

    /**
     * @return mixed
     */
    public function getSubject();

    /**
     * @param mixed $subject
     *
     * @return $this
     */
    public function setSubject($subject);
}
