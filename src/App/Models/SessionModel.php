<?php


namespace App\Models;


use App\DTO\AbstractDTO;
use App\DTO\SessionDTO;

class SessionModel extends AbstractModel
{

    /**
     * Название таблицы
     * @var string
     */
    protected string $tableName = 'users_sessions';

    /**
     * SessionModel constructor.
     * @param SessionDTO $dto
     */
    public function __construct(SessionDTO $dto)
    {
        parent::__construct($dto);
        $this->dto = $dto;
    }

    /**
     * Проверка на существование сессии
     * @return bool
     */
    public function isExist(): bool
    {
        // TODO: Implement isExist() method.
    }

    /**
     * Обновление access_token в БД
     * @return bool
     */
    public function update(): bool
    {
        return $this->provider->replace(
            $this->tableName,
            [
                'user_id',
                'access_token'
            ],
            [
                $this->dto->getUserId(),
                $this->dto->getAccessToken()
            ]
        );
    }
}