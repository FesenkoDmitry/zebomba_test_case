<?php

namespace App\Http;

class Response
{
    /**
     * @var array
     */
    private array $responseData;

    /**
     * Response constructor.
     */
    public function __construct(string $error = '', string $errorKey = '', array $data = [])
    {
        if (!empty($data)){
            $this->responseData = $data;
        }

        $this->responseData['error'] = $error;
        $this->responseData['error_key'] = $errorKey;
    }

    /**
     * Возвращает ответ в JSON
     */
    public function toJson(): void
    {
        echo json_encode($this->responseData);
    }

}