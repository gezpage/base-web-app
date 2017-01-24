<?php

namespace Gez\Repository;

use Doctrine\DBAL\Connection;

abstract class AbstractRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }
}
