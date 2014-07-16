<?php

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

use Froebel\Import\Reader\DBALReader;

class DBALReaderTest extends PHPUnit_Framework_TestCase
{
    protected function ensureConnection()
    {
        $params = array(
            'driver' => 'pdo_sqlite',
            'memory' => true,
        );

        $conn = DriverManager::getConnection($params, new Configuration());
        $conn->exec('CREATE TABLE data (n integer not null, primary key (n))');
        $conn->exec('INSERT INTO data (n) VALUES (1)');
        $conn->exec('INSERT INTO data (n) VALUES (2)');
        $conn->exec('INSERT INTO data (n) VALUES (3)');

        return $conn;
    }

    public function testRead()
    {
        $conn = $this->ensureConnection();
        $reader = new DBALReader($conn, 'SELECT n FROM data');

        $expected = array(array('n' => '1'), array('n' => '2'), array('n' => '3'));
        $actual = array();
        foreach ($reader->read() as $item) {
            $actual[] = $item;
        }

        $this->assertSame($expected, $actual);
    }
}