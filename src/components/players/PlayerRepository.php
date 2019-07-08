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

    protected $itemClass = Player::class;
    protected $pk = Player::FIELD__NAME;
    protected $name = 'players';
    protected $scope = 'extas';
    protected $idAs = '';
}
