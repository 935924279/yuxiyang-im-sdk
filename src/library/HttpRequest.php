<?php

namespace Lanyue\ImSdk\library;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class HttpRequest
{
    public static $client;

    public function __construct()
    {
        self::$client = new Client();
    }

    /**
     * @throws Exception
     */
    public static function get(string $uri, array $params, $headers=[]){
        $options['query'] = $params;
        if($headers){
            $options['headers'] = $headers;
        }
        try {
            $result = (new Client())->request('GET', $uri, $options);
            $content = $result->getBody()->getContents();
            return json_decode($content, true);
        }catch (GuzzleException $e) {
            return json_encode(['msg'=>$e->getMessage(),'code'=>$e->getCode()]);
        }
    }


    /**
     * @throws Exception
     */
    public static function post(string $uri, array $params, $headers=[])
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
            return json_decode($content, true);
        } catch (GuzzleException $e) {
            return json_encode(['msg'=>$e->getMessage(),'code'=>$e->getCode()]);
        }


    }
}