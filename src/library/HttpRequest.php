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
        $result = (new Client())->request('GET', $uri, $options);
        return [
            'httpCode'=>$result->getstatuscode(),
            'body' => $result->getBody()->getContents()
        ];
    }


    public static function post(string $uri,array $params,$headers=[]){
        $options['body'] = $params;
        $header = [ 'Accept'     => 'application/json'];
        if($headers){
            $header = array_merge($header,$headers);
        }
        $options['headers'] = $header;
        $result = (new Client())->request('POST', $uri, $options);
        return [
            'httpCode'=>$result->getstatuscode(),
            'body' => $result->getBody()->getContents()
        ];
    }
}