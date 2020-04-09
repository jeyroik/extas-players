<?php

use PHPUnit\Framework\TestCase;
use extas\components\players\Player;
use extas\components\samples\parameters\SampleParameter;
use extas\interfaces\players\IHasPlayer;
use extas\components\players\THasPlayer;
use extas\components\SystemContainer;
use extas\interfaces\players\IPlayerRepository;
use extas\components\players\PlayerRepository;
use extas\interfaces\repositories\IRepository;
use extas\components\Item;

/**
 * Class PlayerTest
 *
 * @author jeyroik@gmail.com
 */
class PlayerTest extends TestCase
{
    protected ?IRepository $playerRepo = null;

    protected function setUp(): void
    {
        parent::setUp();
        $env = \Dotenv\Dotenv::create(getcwd() . '/tests/');
        $env->load();

        $this->playerRepo = new PlayerRepository();

        SystemContainer::addItem(
            IPlayerRepository::class,
            PlayerRepository::class
        );
    }

    public function tearDown(): void
    {
        $this->playerRepo->delete([Player::FIELD__NAME => 'test']);
    }

    public function testAliases()
    {
        $player = new Player();
        $player->setAliases(['test']);
        $this->assertTrue($player->hasAlias('test'));

        $player->removeAlias('test');
        $this->assertFalse($player->hasAlias('test'));

        $player->addAlias('test2');
        $this->assertEquals(['test2'], $player->getAliases());
    }

    public function testIdentities()
    {
        $player = new Player();
        $player->setIdentities([
            [
                SampleParameter::FIELD__NAME => 'test',
                SampleParameter::FIELD__VALUE => 'test'
            ]
        ]);
        $this->assertTrue($player->hasIdentity('test'));
        $this->assertNotEmpty($player->getIdentity('test'));

        $player->removeIdentity('test');
        $this->assertFalse($player->hasIdentity('test'));

        $player->setIdentity(new SampleParameter([
            SampleParameter::FIELD__NAME => 'test2'
        ]));
        $this->assertCount(1, $player->getIdentities());
        $this->assertEquals('default', $player->getIdentity('test2')->getValue('default'));
        $player->updateIdentityValue('test2', 'test2');

        $this->assertEquals('test2', $player->getIdentityValue('test2'));
        $player->removeIdentity('test2');

        $player->setIdentities([
            [
                SampleParameter::FIELD__NAME => 'test3',
                SampleParameter::FIELD__VALUE => 'test3'
            ],
            new SampleParameter([
                SampleParameter::FIELD__NAME => 'test4',
                SampleParameter::FIELD__VALUE => 'test4'
            ])
        ]);
        $this->assertCount(2, $player->getIdentities());
    }

    public function testSettings()
    {
        $player = new Player();
        $player->setSettings([
            [
                SampleParameter::FIELD__NAME => 'test',
                SampleParameter::FIELD__VALUE => 'test'
            ]
        ]);
        $this->assertTrue($player->hasSetting('test'));
        $this->assertNotEmpty($player->getSetting('test'));

        $player->removeSetting('test');
        $this->assertFalse($player->hasSetting('test'));

        $player->setSetting(new SampleParameter([
            SampleParameter::FIELD__NAME => 'test2'
        ]));
        $this->assertCount(1, $player->getSettings());
        $this->assertEquals('default', $player->getSetting('test2')->getValue('default'));
        $player->updateSettingValue('test2', 'test2');

        $this->assertEquals('test2', $player->getSettingValue('test2'));
        $this->assertEquals('default', $player->getSetting('unknown'));
        $player->removeSetting('test2');

        $player->setSettings([
            [
                SampleParameter::FIELD__NAME => 'test3',
                SampleParameter::FIELD__VALUE => 'test3'
            ],
            new SampleParameter([
                SampleParameter::FIELD__NAME => 'test4',
                SampleParameter::FIELD__VALUE => 'test4'
            ])
        ]);
        $this->assertCount(2, $player->getSettings());
    }

    public function testHasPlayer()
    {
        $hasPlayer = new class ([
            IHasPlayer::FIELD__PLAYER_NAME => 'test'
        ]) extends Item {
            use THasPlayer;

            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };
        $this->playerRepo->create(new Player([
            Player::FIELD__NAME => 'test',
            Player::FIELD__ALIASES => ['test']
        ]));
        $this->assertEquals('test', $hasPlayer->getPlayerName());
        $this->assertNotEmpty($hasPlayer->getPlayer());
        $this->assertTrue($hasPlayer->getPlayer()->hasAlias('test'));
    }
}
