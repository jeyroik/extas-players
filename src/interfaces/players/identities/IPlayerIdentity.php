<?php
namespace extas\interfaces\players\identities;

use extas\interfaces\IHasName;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface IPlayerIdentity
 *
 * @package extas\interfaces\players
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IPlayerIdentity extends IHasName, IHasSampleParameters
{
    public const SUBJECT = 'extas.player.identity';
}
