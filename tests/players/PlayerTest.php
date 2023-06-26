<?php
namespace tests\players;

use extas\components\players\Player;
use extas\components\players\PlayerService;
use extas\components\plugins\players\PluginPlayerGetLoggedInByCookie;
use extas\components\plugins\players\PluginPlayerLoginByCookie;
use extas\components\plugins\players\PluginPlayerLogoutByCookie;
use extas\components\plugins\Plugin;
use extas\components\repositories\RepoItem;
use extas\components\repositories\TSnuffRepository;
use extas\interfaces\stages\players\IStagePlayerGetLoggedIn;
use extas\interfaces\stages\players\IStagePlayerLogin;
use extas\interfaces\stages\players\IStagePlayerLogout;
use PHPUnit\Framework\TestCase;

/**
 * Class PlayerTest
 *
 * @author jeyroik@gmail.com
 */
class PlayerTest extends TestCase
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
    }

    protected function tearDown(): void
    {
        $this->dropDatabase(__DIR__);
        $this->deleteRepo('plugins');
        $this->deleteRepo('extensions');
        $this->deleteRepo('players');
    }

    public function testHasPlayer()
    {
        $player = new Player([
            Player::FIELD__NAME => 'test'
        ]);

        $player->plugins()->create(new Plugin([
            Plugin::FIELD__CLASS => PluginPlayerLoginByCookie::class,
            Plugin::FIELD__STAGE => IStagePlayerLogin::NAME,
            Plugin::FIELD__PARAMETERS => [
                PluginPlayerLoginByCookie::PARAM__COOKIE => ['name' => PluginPlayerLoginByCookie::PARAM__COOKIE, 'value' => 'test_player'],
                PluginPlayerLoginByCookie::PARAM__EXPIRATION => ['name' => PluginPlayerLoginByCookie::PARAM__EXPIRATION, 'value' => 86400]
            ]
        ]));

        $player->plugins()->create(new Plugin([
            Plugin::FIELD__CLASS => PluginPlayerGetLoggedInByCookie::class,
            Plugin::FIELD__STAGE => IStagePlayerGetLoggedIn::NAME,
            Plugin::FIELD__PARAMETERS => [
                PluginPlayerGetLoggedInByCookie::PARAM__COOKIE => ['name' => PluginPlayerGetLoggedInByCookie::PARAM__COOKIE, 'value' => 'test_player'],
                PluginPlayerGetLoggedInByCookie::PARAM__EXPIRATION => ['name' => PluginPlayerGetLoggedInByCookie::PARAM__EXPIRATION, 'value' => 86400]
            ]
        ]));

        $player->plugins()->create(new Plugin([
            Plugin::FIELD__CLASS => PluginPlayerLogoutByCookie::class,
            Plugin::FIELD__STAGE => IStagePlayerLogout::NAME,
            Plugin::FIELD__PARAMETERS => [
                PluginPlayerLogoutByCookie::PARAM__COOKIE => ['name' => PluginPlayerLogoutByCookie::PARAM__COOKIE, 'value' => 'test_player']
            ]
        ]));

        $service = new PlayerService();
        $this->assertTrue($service->login($player));
        $this->assertEquals('test', $service->getLoggedIn()->getName());
        $this->assertTrue($service->logout($player));
        $this->assertNull($service->getLoggedIn());
    }
}
