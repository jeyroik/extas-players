<?php
namespace extas\components\players;

use extas\components\Item;
use extas\interfaces\players\IPlayerToken;

/**
 * Class PlayerToken
 *
 * @package extas\components\players
 * @author jeyroiK@gmail.com
 */
class PlayerToken extends Item implements IPlayerToken
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return sha1(time() . mt_rand(1000, 9999) . serialize($this->getSubject()));
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->config[static::FIELD__SUBJECT] ?? '';
    }

    /**
     * @param mixed $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->config[static::FIELD__SUBJECT] = $subject;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
