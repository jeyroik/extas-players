<?php
namespace tests\players;

use extas\components\players\identities\PlayerIdentity;
use extas\components\players\identities\PlayerIdentityDriver;
use extas\components\players\PlayerGroup;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\interfaces\players\IHasPlayer;
use extas\components\players\Player;
use extas\components\samples\parameters\SampleParameter;
use extas\components\players\THasPlayer;
use extas\components\Item;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * Class PlayerTest
 *
 * @author jeyroik@gmail.com
 */
class PlayerTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['players', 'name', Player::class]
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
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

        $this->getMagicClass('players')->create(new Player([
            Player::FIELD__NAME => 'test',
            Player::FIELD__ALIASES => ['test']
        ]));
        $this->assertEquals('test', $hasPlayer->getPlayerName());
        $this->assertNotEmpty($hasPlayer->getPlayer());
        $this->assertTrue($hasPlayer->getPlayer()->hasAlias('test'));

        $hasPlayer->setPlayerName('new');
        $this->assertEquals('new', $hasPlayer->getPlayerName());
    }

    public function testGroup()
    {
        $group = new PlayerGroup();
        $this->assertEquals('extas.player.group', $group->__subject());
    }
}
