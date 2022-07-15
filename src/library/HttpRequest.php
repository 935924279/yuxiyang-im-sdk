<?php

namespace Lanyue\ImSdk\library;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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


    public static function post(string $uri,array $params,$headers=[])
    {
        $options['json'] = $params;
        $header = ['Accept' => 'application/json'];
        if ($headers) {
            $header = array_merge($header, $headers);
        }
        $options['headers'] = $header;
        try {
            $result = (new Client())->request('POST', $uri, $options);
            $content = $result->getBody()->getContents();
            var_dump($content);
            var_dump(json_decode($content, true));
            return [
                'httpCode' => $result->getstatuscode(),
                'body' => json_decode($content, true)
            ];

        } catch (GuzzleException $e) {
            throw new \Exception($e->getMessage());
        }


    }
}