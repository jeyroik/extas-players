<?php
namespace extas\components\players;

use extas\components\Item;
use extas\interfaces\parameters\IParam;
use extas\interfaces\players\IPlayer;
use extas\interfaces\players\IPlayerService;
use extas\interfaces\stages\players\IStagePlayerGetLoggedIn;
use extas\interfaces\stages\players\IStagePlayerLogin;
use extas\interfaces\stages\players\IStagePlayerLogout;
use Ramsey\Uuid\Uuid;

class PlayerService extends Item implements IPlayerService
{
    /**
     * @var ?IPlayer
     */
    protected static $loggedIn = null;

    public function login(IPlayer $player): bool
    {
        $loggedIn = false;

        foreach ($this->getPluginsByStage(IStagePlayerLogin::NAME) as $plugin) {
            /**
             * @var IStagePlayerLogin $plugin
             */
            $plugin($player, $loggedIn);
        }

        self::$loggedIn = $player;

        return $loggedIn;
    }

    public function logout(IPlayer $player): bool
    {
        $loggedOut = false;

        foreach ($this->getPluginsByStage(IStagePlayerLogout::NAME) as $plugin) {
            /**
             * @var IStagePlayerLogout $plugin
             */
            $plugin($player, $loggedOut);
        }

        self::$loggedIn = null;

        return $loggedOut;
    }

    public function getLoggedIn(): ?IPlayer
    {
        $player = self::$loggedIn;

        if ($player) {
            return $player;
        }

        foreach ($this->getPluginsByStage(IStagePlayerGetLoggedIn::NAME) as $plugin) {
            /**
             * @var IStagePlayerGetLoggedIn $plugin
             */
            $plugin($player);
        }

        self::$loggedIn = $player;

        return $player;
    }

    public function generateToken(IPlayer $player): IPlayer
    {
        $params = $player->buildParams();
        $params->addOne(static::PARAM__TOKEN, [IParam::FIELD__NAME => static::PARAM__TOKEN, IParam::FIELD__VALUE => Uuid::uuid4()->toString()]);
        $player[$player::FIELD__PARAMS] = $params->__toArray();

        return $player;
    }

    public static function getCurrentPlayer(): ?IPlayer
    {
        return (new static())->getLoggedIn();
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
