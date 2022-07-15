<?php

namespace Lanyue\ImSdk\library\app;

use Lanyue\ImSdk\library\HttpRequest;

class Application
{
    public $host;

    public $authorization;
    public $createApp='/app/createApp';
    public $userApps = '/app/userApps';


    public function __construct($token,$host,$port=80)
    {
        $this->host = $host.':'.$port;
        $this->authorization = $token;
    }

    public function createApp($appName,$appDes,$appType='person')
    {
        $url = $this->host.$this->createApp;
        $params = [
            'app_name'=>$appName,
            'app_des'=>$appDes,
            'app_type'=>$appType
        ];
        $headers = [
            "Authorization" => "Bearer ".$this->authorization
        ];
        return HttpRequest::post($url,$params,$headers);
    }

}