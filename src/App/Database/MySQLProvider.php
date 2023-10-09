<?php


namespace App\Database;


class MySQLProvider extends AbstractProvider
{

    /**
     * MySQLProvider constructor.
     */
    public function __construct()
    {
        $this->connectionString = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME;
        $this->connection = new \PDO($this->connectionString, DB_USER, DB_PASSWORD);
    }

    /**
     * Delete из БД
     */
    public function delete()
    {
        // TODO: Implement delete() method.
    }
}