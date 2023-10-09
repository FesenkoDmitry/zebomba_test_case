<?php

namespace App\DTO;

class UserDTO extends AbstractDTO
{
    /**
     * @var int
     */
    private int $id;
    /**
     * @var string
     */
    private string $first_name;
    /**
     * @var string
     */
    private string $last_name;
    /**
     * @var string
     */
    private string $city;
    /**
     * @var string
     */
    private string $country;

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName(string $first_name): void
    {
        $this->first_name = $first_name;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * Заполняет DTO данными из массива
     * @param array $data
     */
    public function fromArray(array $data): void
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

    /**
     * Сериализация в массив
     * @return array
     */
    public function toArray(): array
    {
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties();

        $result = [];
        foreach ($props as $prop) {
            $name = $prop->getName();
            if (!empty($this->$name)){
                $result[$name] = $this->$name;
            }
        }
        return $result;
    }

}