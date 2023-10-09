<?php

require_once __DIR__ . '/src/autoload.php';

use App\Utils\Validator;
use App\Http\Response;
use App\DTO\UserDTO;
use App\Models\UserModel;
use App\DTO\SessionDTO;
use App\Models\SessionModel;

if (Validator::isSigValid($_GET)){
    $user = new UserDTO();
    $user->fromArray($_GET);
    $userModel = new UserModel($user);
    if ($userModel->isExist()){
        $userModel->update();
    } else {
        $userModel->create();
    }
    $session = new SessionDTO();
    $session->fromArray($_GET);
    $session->setUserId($user->getId());
    $sessionModel = new SessionModel($session);
    $sessionModel->update();
    $responseData = [
        'access_token' => $session->getAccessToken(),
        'user_info' => $user->toArray(),
    ];
    $response = new Response('', '', $responseData);
} else {
    $error = 'Ошибка авторизации в приложении';
    $errorKey = 'signature error';
    $response = new Response($error, $errorKey);
    $response->toJson();
}