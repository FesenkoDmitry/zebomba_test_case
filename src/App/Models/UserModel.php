<?php


namespace App\Models;

use App\DTO\AbstractDTO;
use App\DTO\UserDTO;

class UserModel extends AbstractModel
{

    /**
     * Название таблицы
     * @var string
     */
    protected string $tableName = 'users';

    /**
     * UserModel constructor.
     * @param UserDTO $dto
     */
    public function __construct(UserDTO $dto)
    {
        parent::__construct($dto);
        $this->dto = $dto;
    }

    /**
     * Проверяет существование юзера по ID
     * @return bool
     */
    public function isExist(): bool
    {
        return !empty($this->provider->select($this->tableName, ['id'], ['id' => $this->dto->getId()]));
    }

    /**
     * Обновление пользователя в БД
     * @return bool
     */
    public function update(): bool
    {
        return $this->provider->update(
            $this->tableName,
            [
                'first_name',
                'last_name',
                'city',
                'country'
            ],
            [
                $this->dto->getFirstName(),
                $this->dto->getLastName(),
                $this->dto->getCity(),
                $this->dto->getCountry()
            ],
            [
                'id' => $this->dto->getId()
            ]);
    }

    /**
     * Создание пользователя в БД
     * @return bool
     */
    public function create(): bool
    {
        return $this->provider->insert(
            $this->tableName,
            [
                'id',
                'first_name',
                'last_name',
                'city',
                'country'
            ],
            [
                $this->dto->getId(),
                $this->dto->getFirstName(),
                $this->dto->getLastName(),
                $this->dto->getCity(),
                $this->dto->getCountry()
            ]
        );
    }
}