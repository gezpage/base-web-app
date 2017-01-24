<?php

namespace Gez\Repository;

use Doctrine\DBAL\Connection;

/**
 * Class AbstractRepository
 *
 * @package Gez\Repository
 */
abstract class AbstractRepository
{
    /** @var Connection */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
