<?php

namespace App\Models;

use App\Database\AbstractProvider;
use App\Database\MySQLProvider;
use App\DTO\AbstractDTO;

abstract class AbstractModel
{
    /**
     * Имя таблицы
     * @var string
     */
    protected string $tableName;
    /**
     * @var AbstractDTO
     */
    protected AbstractDTO $dto;

    /**
     * @var AbstractProvider
     */
    protected AbstractProvider $provider;

    /**
     * AbstractModel constructor.
     * @param AbstractDTO $dto
     */
    public function __construct(AbstractDTO $dto)
    {
        $this->provider = new MySQLProvider();
    }

    /**
     * Проверяет наличие сущности в БД
     * @return bool
     */
    abstract public function isExist(): bool;
}