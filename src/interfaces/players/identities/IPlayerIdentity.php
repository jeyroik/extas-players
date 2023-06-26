<?php
namespace extas\interfaces\players\identities;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IHasValue;
use extas\interfaces\IHaveUUID;
use extas\interfaces\players\IHavePlayer;

/**
 * Interface IPlayerIdentity
 * 
 * {
 *  "name": "keycloak",
 *  "title": "SSO Keycloak",
 *  "description": "SSO Keycloak",
 *  "value": "jeyroik@gmail.com",
 *  "player_name": "jeyroik"
 * }
 *
 * @package extas\interfaces\players
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IPlayerIdentity extends IHaveUUID, IHasName, IHasDescription, IHasValue, IHavePlayer
{
    public const SUBJECT = 'extas.player.identity';
}
