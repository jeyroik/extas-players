<?php
namespace tests\players\misc;

use extas\components\exceptions\AlreadyExist;
use extas\components\exceptions\MissedOrUnknown;
use extas\components\Item;
use extas\components\players\identities\PlayerIdentity;
use extas\interfaces\players\identities\IPlayerIdentity;
use extas\interfaces\players\identities\IPlayerIdentityDriverDispatcher;
use extas\interfaces\players\IHasPlayer;
use extas\interfaces\players\IPlayer;
use extas\interfaces\repositories\IRepository;

/**
 * Class IdentityDriver
 *
 * @method IRepository playersIdentities()
 *
 * @package tests\players\misc
 * @author jeyroik <jeyroik@gmail.com>
 */
class IdentityDriver extends Item implements IPlayerIdentityDriverDispatcher
{
    protected const DRIVER__NAME = 'test-driver';

    /**
     * @param IPlayer $player
     * @param array $args
     * @return IPlayerIdentity
     * @throws AlreadyExist
     */
    public function create(IPlayer $player, array $args = []): IPlayerIdentity
    {
        $name = $this->buildName($args);

        $identity = new PlayerIdentity([
            PlayerIdentity::FIELD__NAME => $name,
            PlayerIdentity::FIELD__PLAYER_NAME => $player->getName(),
            PlayerIdentity::FIELD__DRIVER => static::DRIVER__NAME,
            PlayerIdentity::FIELD__PARAMETERS => []
        ]);

        $one = $this->playersIdentities()->one([PlayerIdentity::FIELD__NAME => $name]);

        if ($one) {
            throw new AlreadyExist('identity for "' . $player->getName() . '"');
        }

        $this->playersIdentities()->create($identity);

        return $identity;
    }

    /**
     * @param array $args
     * @return IPlayerIdentity
     * @throws MissedOrUnknown
     */
    public function resolve(array $args = []): IPlayerIdentity
    {
        $name = $this->buildName($args);

        $one = $this->playersIdentities()->one([PlayerIdentity::FIELD__NAME => $name]);

        if (!$one) {
            $login = $args['login'] ?? '';
            throw new MissedOrUnknown('identity for "' . $login . '"');
        }

        return $one;
    }

    /**
     * @param array $args
     * @return bool
     * @throws MissedOrUnknown
     */
    public function delete(array $args = []): bool
    {
        $one = $this->resolve($args);
        $this->playersIdentities()->delete([], $one);

        return true;
    }

    /**
     * @param array $args
     * @return string
     */
    protected function buildName(array $args): string
    {
        $login = $args['login'] ?? '';
        $password = $args['password'] ?? '';

        return 'test-driver__' . $login . sha1($password);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'test';
    }
}
