<?php

namespace Lanyue\ImSdk\library\im;

use Exception;
use Lanyue\ImSdk\library\HttpRequest;

class User
{
    protected $websocket_url = '/api/user/wsToken';
    protected $host;
    protected $appid;
    public function __construct(string $appid, string $host)
    {
        $this->host = $host;
        $this->appid = $appid;
    }

    /**
     * @throws Exception
     */
    public function websocket(array $from_user)
    {
        $params = [
            'from_user'=>$from_user
        ];
        $url = $this->host.$this->websocket_url;
        $header = ['appid'=>$this->appid];
        try {
            return HttpRequest::post($url, $params, $header);
        } catch (Exception $e) {
            return json_encode(['msg'=>$e->getMessage(),'code'=>$e->getCode()]);
        }

    }
}