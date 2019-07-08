<?php
namespace extas\components\players;

use extas\components\SystemContainer;
use extas\interfaces\players\IHasOwner;
use extas\interfaces\players\IPlayer;
use extas\interfaces\players\IPlayerRepository;

/**
 * Trait THasOwner
 *
 * Реализация интерфейса extas\interfaces\IHasOwner
 *
 * @property $config
 *
 * @package extas\components
 * @author jeyroik@gmail.com
 */
trait THasOwner
{
    static protected $owners = [];

    /**
     * @return string
     */
    public function getOwnerName(): string
    {
        return $this->config[IHasOwner::FIELD__OWNER] ?? '';
    }

    /**
     * @return IPlayer|null
     */
    public function getOwner(): ?IPlayer
    {
        $name = $this->getOwnerName();

        if (!isset($this->owners[$name])) {
            /**
             * @var $playerRepo IPlayerRepository
             * @var $player IPlayer
             */
            $playerRepo = SystemContainer::getItem(IPlayerRepository::class);
            $player = $playerRepo->one([IPlayer::FIELD__NAME => $name]);

            if ($player) {
                self::$owners[$name] = $player;
            }
        }

        return self::$owners[$name];
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setOwnerName(string $name)
    {
        $this->config[IHasOwner::FIELD__OWNER] = $name;

        return $this;
    }

    /**
     * @param IPlayer $player
     *
     * @return $this
     */
    public function setOwner(IPlayer $player)
    {
        $this->config[IHasOwner::FIELD__OWNER] = $player->getName();

        return $this;
    }
}
