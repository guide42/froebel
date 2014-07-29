<?php

namespace Froebel\Import\Reader;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\PDOConnection;

class SQLFileReader extends DBALReader
{
    public function __construct($file, Connection $connection, $sql, array $params = array())
    {
        $conn = $connection->getWrappedConnection();

        if ($conn instanceof PDOConnection) {
            $this->importPDO($conn, $file);
        } else {
            throw new \LogicException(
                "Non PDO connections not yet implemented."
            );
        }

        parent::__construct($connection, $sql, $params);
    }

    protected function importPDO(PDOConnection $connection, $file)
    {
        $filename = realpath($file);

        if (!file_exists($filename)) {
            throw new \InvalidArgumentException(
                sprintf("SQL file '<info>%s</info>' does not exist.", $filename)
            );
        } elseif (!is_readable($filename)) {
            throw new \InvalidArgumentException(
                sprintf("SQL file '<info>%s</info>' does not have read permissions.", $filename)
            );
        }

        $sql = file_get_contents($filename);

        $stmt = $connection->prepare($sql);
        $stmt->execute();

        do {
            // If trying to fetch() when CREATE/INSERT/UPDATE will give the
            // error: `SQLSTATE[HY000]: General error`.
            //$stmt->fetch();
            $stmt->closeCursor();
        } while ($stmt->nextRowset());
    }
}