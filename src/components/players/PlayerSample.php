<?php
namespace extas\components\players;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasAliases;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\players\IPlayerSample;

/**
 * Class PlayerSample
 *
 * @package extas\components\players
 * @author jeyroik <jeyroik@gmail.com>
 */
class PlayerSample extends Item implements IPlayerSample
{
    use THasSampleParameters;
    use THasName;
    use THasDescription;
    use THasAliases;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.player.sample';
    }
}
