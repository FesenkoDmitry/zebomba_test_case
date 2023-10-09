<?php

namespace App\DTO;

class SessionDTO extends AbstractDTO
{
    /**
     * @var int
     */
    private int $user_id;

    /**
     * @var string
     */
    private string $access_token;

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->access_token;
    }

    /**
     * @param string $access_token
     */
    public function setAccessToken(string $access_token): void
    {
        $this->access_token = $access_token;
    }

    /**
     * Заполняет DTO данными из массива
     * @param array $data
     */
    public function fromArray(array $data)
    {
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties();

        foreach ($props as $prop) {
            $name = $prop->getName();
            if (!empty($data[$name])){
                $this->$name = $data[$name];
            }
        }
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}