<?php

namespace App\Utils;

class Validator
{

    /**
     * Проверка подписи
     * @param array $requestData
     * @return bool
     */
    public static function isSigValid(array $requestData): bool
    {
        $sig = self::createSig($requestData);
        return mb_strtolower(md5($sig)) === $requestData['sig'];
    }

    /**
     * Создание подписи из данных входящего запроса
     * @param array $requestData
     * @return string
     */
    public static function createSig(array $requestData): string
    {
        ksort($requestData);
        $sig = '';
        foreach ($requestData as $key => $value){
            if ($key != 'sig')
            $sig .= "$key=$value";
        }
        $sig .= APP_SECRET;

        return $sig;
    }
}