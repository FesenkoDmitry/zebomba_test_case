<?php


namespace App\DTO;


abstract class AbstractDTO
{
    abstract public function fromArray(array $data);
    abstract public function toArray();
}