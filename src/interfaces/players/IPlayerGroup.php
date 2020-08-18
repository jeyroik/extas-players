<?php
namespace extas\interfaces\players;

/**
 * Interface IPlayerGroup
 *
 * @package extas\interfaces\players
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IPlayerGroup extends IPlayerSample
{
    public const SUBJECT = 'extas.player.group';

    public const PARAM__IS_PRIVATE = 'is_private';
    public const PARAM__CREATOR = 'creator';
    public const PARAM__CREATED_AT = 'created_at';
    public const PARAM__MEMBERS_COUNT = 'members_count';
}
