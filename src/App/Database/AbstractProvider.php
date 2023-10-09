<?php

namespace App\Database;

abstract class AbstractProvider
{
    protected string $connectionString;
    protected \PDO $connection;

    /**
     * @return mixed
     */
    abstract public function delete();

    /**
     * Select из БД
     * @param string $tableName
     * @param array $columns
     * @param array $whereParams
     * @return array
     */
    public function select(string $tableName, array $columns = [], array $whereParams = []): array
    {
        if (!empty($columns)) {
            $selectColumns = implode(', ', $columns);
        } else {
            $selectColumns = '*';
        }

        $whereCondition = $this->makeWhereCondition($whereParams);
        $sql = "SELECT $selectColumns FROM $tableName $whereCondition";
        $stmt = $this->connection->prepare($sql);

        foreach ($whereParams as $param => $value) {
            $stmt->bindParam(":$param", $value);
        }
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result ?? [];
    }

    /**
     * Insert в БД
     * @param string $tableName
     * @param array $columns
     * @param array $values
     * @return bool
     */
    public function insert(string $tableName, array $columns, array $values): bool
    {
        $insertColumns = implode(', ', $columns);
        $preparedColumns = array_map(function ($column) {
            return ":$column";
        }, $columns);
        $insertValues = implode(', ', $preparedColumns);

        $sql = "INSERT INTO $tableName ($insertColumns) VALUES ($insertValues)";
        $stmt = $this->connection->prepare($sql);
        foreach ($preparedColumns as $key => $column) {
            $stmt->bindParam($column, $values[$key]);
        }
        return $stmt->execute();
    }

    /**
     * Replace в БД
     * @param string $tableName
     * @param array $columns
     * @param array $values
     * @return bool
     */
    public function replace(string $tableName, array $columns, array $values): bool
    {
        $preparedColumns = array_map(function ($column) {
            return ":$column";
        }, $columns);
        $insertValues = implode(', ', $preparedColumns);

        $sql = "REPLACE INTO $tableName VALUES ($insertValues)";
        $stmt = $this->connection->prepare($sql);
        foreach ($preparedColumns as $key => $column) {
            $stmt->bindParam($column, $values[$key]);
        }
        return $stmt->execute();

    }

    /**
     * Update в БД
     * @param string $tableName
     * @param array $columns
     * @param array $values
     * @param array $whereParams
     * @return bool
     */
    public function update(string $tableName, array $columns, array $values, array $whereParams): bool
    {
        $updateValues = '';
        foreach ($columns as $key => $column) {
            $updateValues .= "$column=:$column";
            if (!$key == array_key_last($columns)) {
                $updateValues .= ',';
            }
        }
        $whereCondition = $this->makeWhereCondition($whereParams);
        $sql = "UPDATE $tableName SET $updateValues $whereCondition";
        $stmt = $this->connection->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindParam(":$columns[$key]", $value);
        }
        return $stmt->execute();
    }

    /**
     * Составление условия WHERE для prepared statement
     * @param array $whereParams
     * @return string
     */
    private function makeWhereCondition(array $whereParams): string
    {
        $whereCondition = '';
        if (!empty($whereParams)) {
            $whereCondition = 'where';
            foreach ($whereParams as $param => $value) {
                $whereCondition .= " $param = :$param";
                if ($param == array_key_last($whereParams)) {
                    $whereCondition .= ';';
                } else {
                    $whereCondition .= ',';
                }
            }
        }

        return $whereCondition;
    }
}