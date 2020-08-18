<?php
namespace extas\interfaces\players;

use extas\interfaces\IHasAliases;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface IPlayerSample
 *
 * @package extas\interfaces\players
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IPlayerSample extends IItem, IHasName, IHasSampleParameters, IHasDescription, IHasAliases
{
}
