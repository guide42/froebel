<?php

namespace Froebel\Import\Reader;

use Doctrine\DBAL\Connection;

class DBALReader implements Reader
{
    protected $connection;

    protected $stmt;

    protected $executed = false;

    public function __construct(Connection $connection, $sql, array $params = array())
    {
        $this->connection = $connection;
        $this->stmt = $this->connection->prepare($sql);

        foreach ($params as $key => $value) {
            $this->stmt->bindValue($key, $value);
        }
    }

    public function getIterator()
    {
        if (false === $this->executed) {
            $this->stmt->execute();
            $this->executed = true;
        }

        return new \ArrayIterator($this->stmt->fetchAll());
    }

    public function read()
    {
        if (false === $this->executed) {
            $this->stmt->execute();
            $this->executed = true;
        }

        while ($row = $this->stmt->fetch()) {
            yield $row;
        }
    }
}