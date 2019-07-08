<?php
namespace extas\components\players;

use extas\components\THasId;
use extas\interfaces\players\IPlayerIdentity;
use extas\components\Item;

/**
 * Class PlayerIdentity
 *
 * @package extas\components\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
class PlayerIdentity extends Item implements IPlayerIdentity
{
    use THasId;

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->config[static::FIELD__SECRET] ?? '';
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->config[static::FIELD__SOURCE] ?? '';
    }

    /**
     * @param $secret
     *
     * @return IPlayerIdentity
     */
    public function setSecret($secret)
    {
        $this->config[static::FIELD__SECRET] = $secret;

        return $this;
    }

    /**
     * @param $source
     *
     * @return IPlayerIdentity
     */
    public function setSource($source)
    {
        $this->config[static::FIELD__SOURCE] = $source;

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
