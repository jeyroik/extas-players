<?php
namespace tests\players;

use extas\components\players\identities\PlayerIdentity;
use extas\components\players\identities\PlayerIdentityDriver;
use extas\components\players\identities\PlayerIdentityFactory;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\interfaces\players\IHasPlayer;
use extas\components\players\Player;
use extas\components\samples\parameters\SampleParameter;
use extas\components\players\THasPlayer;
use extas\components\Item;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use tests\players\misc\IdentityDriver;

/**
 * Class PlayerIdentityTest
 *
 * @author jeyroik@gmail.com
 */
class PlayerIdentityTest extends TestCase
{
    use TSnuffRepositoryDynamic;
    use THasMagicClass;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['players', 'name', Player::class],
            ['playersIdentities', 'name', PlayerIdentity::class],
            ['identityDrivers', 'name', PlayerIdentityDriver::class],
        ]);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testCreateIdentity()
    {
        $this->getMagicClass('identityDrivers')->create(new PlayerIdentityDriver([
            PlayerIdentityDriver::FIELD__NAME => 'test-driver',
            PlayerIdentityDriver::FIELD__CLASS => IdentityDriver::class
        ]));

        $factory = new PlayerIdentityFactory();
        $player = new Player([
            Player::FIELD__NAME => 'test'
        ]);
        $identity = $factory->createIdentity($player, 'test-driver', [
            'login' => 'test',
            'password' => 'test'
        ]);

        $this->assertEquals($player->getName(), $identity->getPlayerName());

        $identity = $factory->getIdentity('test-driver', [
            'login' => 'test',
            'password' => 'test'
        ]);

        $this->assertEquals($player->getName(), $identity->getPlayerName());

        $factory->deleteIdentity('test-driver', [
            'login' => 'test',
            'password' => 'test'
        ]);

        $this->expectExceptionMessage('Missed or unknown identity for "test"');
        $factory->getIdentity('test-driver', [
            'login' => 'test',
            'password' => 'test'
        ]);
    }
}
