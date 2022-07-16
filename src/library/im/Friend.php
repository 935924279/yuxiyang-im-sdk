<?php

namespace Lanyue\ImSdk\library\im;

use Exception;
use Lanyue\ImSdk\library\HttpRequest;

class Friend
{
    protected $create_chat_url = '/api/friend/createChat';
    protected $send_message_url = '/api/friend/sendMessage';
    protected $app_list_url = '/api/friend/appList';
    protected $get_chat_history_url = '/api/friend/getChatHistory';
    protected $host;
    protected $appid;
    protected $header = [];

    public function __construct(string $appid, string $host)
    {
        $this->host = $host;
        $this->appid = $appid;
        $this->header = ['appid' => $appid];
    }

    /**
     * 创建单聊
     * @param array $from_user
     * @param array $to_user
     * @return mixed
     * @throws Exception
     */
    public function createChat(array $from_user,array $to_user)
    {
        $params = [
            'from_user'=>$from_user,
            'to_user'=>$to_user
        ];
        $url = $this->host . $this->create_chat_url;

        return HttpRequest::post($url, $params, $this->header);
    }

    /**
     * 发送单聊消息
     * @param int $friend_group_id
     * @param string $uniqued
     * @param array $conntent
     * @return array
     * @throws Exception
     */
    public function sendMessage(int $friend_group_id, string $uniqued, array $conntent)
    {
        $param['friend_group_id'] = $friend_group_id;
        $param['uniqued'] = $uniqued;
        $param['content'] = $conntent;
        $url = $this->host . $this->send_message_url;
        return HttpRequest::post($url, $param, $this->header);
    }

    /**
     * 单聊列表
     * @param string $uniqued
     * @param int $page
     * @param int $size
     * @return false|mixed|string
     * @throws Exception
     */
    public function appList(string $uniqued, int $page = 1, int $size = 10)
    {
        $param['uniqueid'] = $uniqued;
        $param['page'] = $page;
        $param['size'] = $size;
        $url = $this->host . $this->app_list_url;
        try {
            return HttpRequest::get($url, $param, $this->header);
        } catch (Exception $e) {
            return json_encode(['msg'=>$e->getMessage(),'code'=>$e->getCode()]);
        }
    }

    /**
     * 单聊记录
     * @param int $friend_group_id
     * @param string $uniqued
     * @param int $page
     * @param int $size
     * @return false|mixed|string
     */
    public function getChatHistory(int $friend_group_id, string $uniqued, int $page = 1, int $size = 10)
    {
        $param['uniqueid'] = $uniqued;
        $param['friend_group_id'] = $friend_group_id;
        $param['page'] = $page;
        $param['size'] = $size;
        $url = $this->host . $this->get_chat_history_url;
        try {
            return HttpRequest::get($url, $param, $this->header);
        } catch (Exception $e) {
            return json_encode(['msg'=>$e->getMessage(),'code'=>$e->getCode()]);
        }
    }


}