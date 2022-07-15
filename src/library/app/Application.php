<?php

namespace Lanyue\ImSdk\library\app;

use Lanyue\ImSdk\library\HttpRequest;

class Application
{
    public $host;

    public $authorization;
    public $createApp='/app/createApp';
    public $userApps = '/app/userApps';


    public function __construct($token, $host, $email, $password)
    {
        $this->host = $host;
        $this->authorization = $token;
        $token = $this->initUser($email, $password);
        $this->authorization = $token;
    }

    public function initUser($email, $password)
    {
        $user = new User($this->host);
        $result = $user->login($email, $password);
        if ($result['httpCode'] == 200 && $result['body']['code'] == 0) {
            return $result['body']['token']['token'];
        } else {
            $row = $user->register($email, $password);
            return $row['body']['token'];
        }
    }

    public function createApp($appName, $appDes, $appType = 'personal')
    {
        $url = $this->host . $this->createApp;
        $params = [
            'app_name' => $appName,
            'app_des' => $appDes,
            'app_type' => $appType
        ];
        $headers = [
            "Authorization" => "Bearer " . $this->authorization
        ];
        return HttpRequest::post($url, $params, $headers);
    }

    public function getApp()
    {
        $url = $this->host . $this->userApps;
        $headers = [
            "Authorization" => "Bearer " . $this->authorization
        ];
        return HttpRequest::post($url, [], $headers);
    }
}