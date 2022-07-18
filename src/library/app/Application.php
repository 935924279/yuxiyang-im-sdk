<?php

namespace Lanyue\ImSdk\library\app;

use Exception;
use Lanyue\ImSdk\library\HttpRequest;

class Application
{
    public $host;

    public $authorization;
    public $createApp='/app/createApp';
    public $userApps = '/app/userApps';


    public function __construct( $email, $password,$host)
    {
        $this->host = $host;
        $this->authorization =  $this->initUser($email, $password);
    }

    public function initUser($email, $password)
    {
        $user = new User($this->host);
        $result = $user->login($email, $password);

        if ( $result['code'] == 0) {
            return $result['token']['token'];
        } else {
            $row = $user->register($email, $password);
            return $row['token']['token'];
        }
    }

    public function createApp(string $appName, string $appDes, $appType = 'personal')
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
        try {
            return HttpRequest::post($url, $params, $headers);
        } catch (Exception $e) {
            return json_encode(['msg'=>$e->getMessage(),'code'=>$e->getCode()]);
        }
    }

    public function getApp()
    {
        $url = $this->host . $this->userApps;
        $headers = [
            "Authorization" => "Bearer " . $this->authorization
        ];
        try {
            return HttpRequest::get($url, [], $headers);
        } catch (Exception $e) {
            return json_encode(['msg'=>$e->getMessage(),'code'=>$e->getCode()]);

        }
    }
}
