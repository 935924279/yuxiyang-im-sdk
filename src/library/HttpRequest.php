<?php

namespace Lanyue\ImSdk\library;

use GuzzleHttp\Client;
class HttpRequest
{
    public static $client;

    public function __construct()
    {
        self::$client = new Client();
    }

    public static function get(string $uri,array $params,$headers=[]){
        $options['query'] = $params;
        if($headers){
            $options['headers'] = $headers;
        }
        $result =   self::$client->request('GET',$uri,$options);
        return [
            'httpCode'=>$result->getstatuscode(),
            'body'=>$result->getBody()
        ];
    }


    public static function post(string $uri,array $params,$headers=[]){
        $options['body'] = $params;
        $header = [ 'Accept'     => 'application/json'];
        if($headers){
            $header = array_merge($header,$headers);
        }
        $options['headers'] = $header;
        $result =   self::$client->request('POST',$uri,$options);
        return [
            'httpCode'=>$result->getstatuscode(),
            'body'=>$result->getBody()
        ];
    }
}