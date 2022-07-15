<?php

namespace Lanyue\ImSdk\library\app;

use Lanyue\ImSdk\library\HttpRequest;

class User
{

    public $host;
    public $Authorization;
    public $url ;

    public $registerUrl='/user/register';
    public $loginUrl = '/user/login';
    public function __construct($host,$port=80)
    {
        $this->host = $host.':'.$port;
    }


    public function register(string $email,string $password='123456')
    {
        $request_url =$this->host.$this->registerUrl;
        $data = [
            'email'=>$email,
            'password'=>$password
        ];
        return HttpRequest::post($request_url,$data);
    }



    public function login(string $email,string $password='123456')
    {
        $request_url =$this->host.$this->loginUrl;
        $data = [
            'email'=>$email,
            'password'=>$password
        ];
        return HttpRequest::post($request_url,$data);
    }
}