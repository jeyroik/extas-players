<?php
namespace extas\components\plugins\players;

use extas\components\players\Player;
use extas\components\players\PlayerIdentity;
use extas\components\players\PlayerSetting;
use extas\components\players\PlayerToken;
use extas\interfaces\players\IPlayer;
use extas\interfaces\players\IPlayerIdentity;
use extas\interfaces\players\IPlayerRepository;
use extas\interfaces\players\IPlayerSetting;
use extas\interfaces\packages\IInstaller;
use extas\components\plugins\Plugin;
use extas\components\SystemContainer;

use jr\components\randoms\RandomString;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PluginInstallPlayers
 *
 * @package extas\components\plugins\players
 * @author jeyroik@gmail.com
 */
class PluginInstallPlayers extends Plugin
{
    const FIELD__PLAYERS = 'players';
    const DIRECTIVE__GENERATE = '@directive.generate()';

    /**
     * @param $serviceInstaller IInstaller
     * @param $output OutputInterface
     */
    public function __invoke(&$serviceInstaller, $output)
    {
        $serviceConfig = $serviceInstaller->getPackageConfig();
        /**
         * @var $playerRepo IPlayerRepository
         */
        $playerRepo = SystemContainer::getItem(IPlayerRepository::class);
        $players = $serviceConfig[static::FIELD__PLAYERS] ?? [];

        foreach ($players as $player) {
            if ($playerRepo->one([IPlayer::FIELD__NAME => $player[IPlayer::FIELD__NAME]])) {
                $output->writeln([
                    'Player <info>"' . $player[IPlayer::FIELD__NAME] . '"</info> is already installed.'
                ]);
            } else {
                $output->writeln([
                    '<info>Installing player "' . $player[IPlayer::FIELD__NAME] . '"...</info>'
                ]);
                $playerWrapped = new Player($player);
                $this->installIdentity($playerWrapped, $serviceInstaller);
                $this->installToken($playerWrapped);
                $playerRepo->create($playerWrapped);
                $output->writeln([
                    '<info>Player installed.</info>'
                ]);
            }
        }
    }

    /**
     * @param $playerWrapped IPlayer
     * @param $installer IInstaller
     */
    protected function installIdentity(&$playerWrapped, &$installer)
    {
        $identity = $playerWrapped->getIdentity($playerWrapped->getName());

        if (!$identity) {
            $identity = new PlayerIdentity([
                IPlayerIdentity::FIELD__ID => $playerWrapped->getName(),
                IPlayerIdentity::FIELD__SOURCE => 'auto-generated-on-install',
                IPlayerIdentity::FIELD__SECRET => static::DIRECTIVE__GENERATE
            ]);
        }

        if ($identity->getSecret() == static::DIRECTIVE__GENERATE) {
            $pass = RandomString::generate(8);
            $installer->addGeneratedData('Player "' . $playerWrapped->getName() . '" password', $pass);
            $identity->setSecret(sha1($pass));
            $playerWrapped->setIdentity($playerWrapped->getName(), $identity);
        }
    }

    /**
     * @param $playerWrapped IPlayer
     */
    protected function installToken(&$playerWrapped)
    {
        $token = $playerWrapped->getSetting('token');

        if (!$token) {
            $token = new PlayerSetting([
                IPlayerSetting::FIELD__NAME => 'token',
                IPlayerSetting::FIELD__ID => static::DIRECTIVE__GENERATE
            ]);
        }

        if ($token->getId() == static::DIRECTIVE__GENERATE) {
            $playerWrapped->setSetting(
                'token',
                [
                    IPlayerSetting::FIELD__NAME => 'token',
                    IPlayerSetting::FIELD__ID => (string) (new PlayerToken([
                        PlayerToken::FIELD__SUBJECT => $playerWrapped->__toArray()
                    ]))
                ]
            );
        }
    }
}
