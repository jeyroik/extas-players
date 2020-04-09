<?php
namespace extas\components\players;

use extas\components\repositories\Repository;
use extas\interfaces\players\IPlayerRepository;

/**
 * Class PlayerRepository
 *
 * @package extas\components\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
class PlayerRepository extends Repository implements IPlayerRepository
{
    protected string $itemClass = Player::class;
    protected string $pk = Player::FIELD__NAME;
    protected string $name = 'players';
    protected string $scope = 'extas';
}
