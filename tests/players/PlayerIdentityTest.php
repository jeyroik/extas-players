<?php
namespace tests\players;

use extas\components\players\identities\PlayerIdentity;
use extas\components\players\identities\PlayerIdentityDriver;
use extas\components\players\identities\PlayerIdentityFactory;
use extas\components\players\identities\PlayerToIdentityMap;
use extas\components\repositories\TSnuffRepositoryDynamic;
use extas\components\THasMagicClass;
use extas\components\players\Player;
use Dotenv\Dotenv;
use extas\interfaces\players\identities\IPlayerToIdentityMap;
use extas\interfaces\players\IPlayer;
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

    protected IPlayer $player;
    protected array $identityData = [
        'login' => 'test',
        'password' => 'test'
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->createSnuffDynamicRepositories([
            ['players', 'name', Player::class],
            ['playersIdentities', 'name', PlayerIdentity::class],
            ['playersIdentitiesMaps', 'name', PlayerToIdentityMap::class],
            ['playersIdentitiesDrivers', 'name', PlayerIdentityDriver::class],
        ]);
        $this->player = new Player([Player::FIELD__NAME => 'test']);
    }

    public function tearDown(): void
    {
        $this->deleteSnuffDynamicRepositories();
    }

    public function testCreateIdentity()
    {
        $this->createDriver();

        $factory = new PlayerIdentityFactory();
        $identity = $factory->createIdentity($this->player, 'test-driver', [
            'login' => 'test',
            'password' => 'test'
        ]);

        $maps = $this->getMagicClass('playersIdentitiesMaps')->all([
            IPlayerToIdentityMap::FIELD__PLAYER_IDENTITY => $identity->getName()
        ]);

        $this->assertCount(1, $maps);

        $map = array_shift($maps);

        $this->assertEquals($this->player->getName(), $map->getPlayerName());

        $identity = $factory->getIdentity('test-driver', $this->identityData);
        $maps = $this->getMagicClass('playersIdentitiesMaps')->all([
            IPlayerToIdentityMap::FIELD__PLAYER_IDENTITY => $identity->getName()
        ]);

        $this->assertCount(1, $maps);

        $map = array_shift($maps);

        $this->assertEquals($this->player->getName(), $map->getPlayerName());

        $factory->deleteIdentity('test-driver', $this->identityData);

        $this->expectExceptionMessage('Missed or unknown identity for "test"');
        $factory->getIdentity('test-driver', $this->identityData);
    }

    public function testIdentityAlreadyExists()
    {
        $this->createDriver();

        $factory = new PlayerIdentityFactory();
        $factory->createIdentity($this->player, 'test-driver', $this->identityData);

        $this->expectExceptionMessage('Identity already exists');
        $factory->createIdentity($this->player, 'test-driver', $this->identityData);
    }

    public function testFactoryUnknownDriver()
    {
        $factory = new PlayerIdentityFactory();

        $this->expectExceptionMessage('Missed or unknown driver "test-driver"');
        $factory->createIdentity($this->player, 'test-driver', $this->identityData);
    }

    protected function createDriver()
    {
        $this->getMagicClass('playersIdentitiesDrivers')->create(new PlayerIdentityDriver([
            PlayerIdentityDriver::FIELD__NAME => 'test-driver',
            PlayerIdentityDriver::FIELD__CLASS => IdentityDriver::class
        ]));
    }
}
