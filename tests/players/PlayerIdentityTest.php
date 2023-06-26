<?php
namespace tests\players;

use extas\components\players\identities\PlayerIdentityProvider;
use extas\components\players\identities\PlayerIdentityService;
use extas\components\players\PlayerService;
use extas\components\repositories\RepoItem;
use extas\components\repositories\TSnuffRepository;
use extas\interfaces\players\identities\IPlayerIdentity;
use extas\interfaces\players\IPlayer;
use PHPUnit\Framework\TestCase;

/**
 * Class PlayerIdentityTest
 *
 * @author jeyroik@gmail.com
 */
class PlayerIdentityTest extends TestCase
{
    use TSnuffRepository;

    protected function setUp(): void
    {
        putenv("EXTAS__CONTAINER_PATH_STORAGE_LOCK=vendor/jeyroik/extas-foundation/resources/container.dist.json");
        $this->buildBasicRepos();
        $this->buildRepo(__DIR__ . '/../../vendor/jeyroik/extas-foundation/resources/', [
            'players' => [
                "namespace" => "tests\\tmp",
                "item_class" => "extas\\components\\players\\Player",
                "pk" => "id",
                "aliases" => ["players"],
                "hooks" => [],
                "code" => [
                    'create-before' => '\\' . RepoItem::class . '::setId($item);'
                                      .'\\' . RepoItem::class . '::throwIfExist($this, $item, [\'name\']);'
                                      .'$item = (new \\' . PlayerService::class . '())->generateToken($item);'
                ]
            ]
        ]);
        $this->buildRepo(__DIR__ . '/../../vendor/jeyroik/extas-foundation/resources/', [
            'players_identities' => [
                "namespace" => "tests\\tmp",
                "item_class" => "extas\\components\\players\\identities\\PlayerIdentity",
                "pk" => "id",
                "aliases" => ["playersIdentities"],
                "hooks" => [],
                "code" => [
                    'create-before' => '\\' . RepoItem::class . '::setId($item);'
                                      .'\\' . RepoItem::class . '::throwIfExist($this, $item, [\'name\',\'value\']);'
                ]
            ]
        ]);
    }

    protected function tearDown(): void
    {
        $this->dropDatabase(__DIR__);
        $this->deleteRepo('plugins');
        $this->deleteRepo('extensions');
        $this->deleteRepo('players');
        $this->deleteRepo('players_identities');
    }

    public function testCreateIdentity()
    {
        $provider = new PlayerIdentityProvider([
            PlayerIdentityProvider::FIELD__AUTHORIZATION_URL => 'auth',
            PlayerIdentityProvider::FIELD__ACCESS_TOKEN_URL => 'token',
            PlayerIdentityProvider::FIELD__USER_DETAILS_URL => 'info',
            PlayerIdentityProvider::FIELD__SCOPES => [],

            PlayerIdentityProvider::FIELD__NAME => 'test name',
            PlayerIdentityProvider::FIELD__TITLE => 'test title',
            PlayerIdentityProvider::FIELD__DESCRIPTION => 'test description'
        ]);

        $service = new PlayerIdentityService();
        $identity = $service->createIdentity($provider, 'test', 'test@test');

        /**
         * @var IPlayer $player
         */
        $player = $service->players()->one([IPlayer::FIELD__NAME => 'test']);
        $this->assertInstanceOf(IPlayer::class, $player);
        $this->assertTrue($player->buildParams()->hasOne('token'));

        $this->assertInstanceOf(IPlayerIdentity::class, $identity);
        $this->assertEquals('test name', $identity->getName());

        $identity2 = $service->createIdentity($provider, 'test', 'test@test');
        $this->assertEquals($identity->getId(), $identity2->getId());
    }
}
