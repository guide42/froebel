<?php

use Froebel\Import\Reader\SQLFileReader;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class SQLFileReaderTest extends PHPUnit_Framework_TestCase
{
    protected function ensureSQLFile()
    {
        $filename = tempnam(sys_get_temp_dir(), 'froebel');

        file_put_contents($filename,
            'CREATE TABLE data (n integer not null, primary key (n));' .
            'INSERT INTO data (n) VALUES (1);' .
            'INSERT INTO data (n) VALUES (2);' .
            'INSERT INTO data (n) VALUES (3)'
        );

        return $filename;
    }

    protected function ensureConnection()
    {
        $params = array(
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'user' => 'root',
        );

        try {
            $conn = DriverManager::getConnection($params, new Configuration());
            $conn->exec('DROP DATABASE IF EXISTS test_froebel');
            $conn->exec('CREATE DATABASE test_froebel');
            $conn->exec('USE test_froebel');
        } catch (\PDOException $e) {
            if (strpos($e->getMessage(), 'SQLSTATE[HY000] [2002]') !== false) {
                $this->markTestSkipped(
                    'A local running MySQL instance is required.'
                );
            }
            throw $e;
        }

        return $conn;
    }

    public function testRead()
    {
        $file = $this->ensureSQLFile();
        $conn = $this->ensureConnection();

        $reader = new SQLFileReader($file, $conn, 'SELECT n FROM data');

        $expected = array(array('n' => '1'), array('n' => '2'), array('n' => '3'));
        $actual = array();
        foreach ($reader->read() as $item) {
            $actual[] = $item;
        }

        $this->assertSame($expected, $actual);
    }
}