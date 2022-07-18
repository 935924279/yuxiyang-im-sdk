<?php

namespace Lanyue\ImSdk\library\im;

use Exception;
use Lanyue\ImSdk\library\HttpRequest;
class Group
{
    //请求地址
    protected $group_create_rul = '/api/group/create';
    protected $add_member_url = '/api/group/addmember';
    protected $send_message_url = '/api/group/send';
    protected $get_chat_history_url = '/api/group/getChatHistory';
    protected $get_group_relation_url = '/api/group/getGroupRelation';
    protected $get_group_info_url = '/api/group/info';
    protected $get_my_group_url = '/api/group/getJoinedGroup';
    protected $delete_group_user_url = '/api/group/deleteGroupUser';
    protected $add_group_auth_user_url = '/api/group/addAuthUser';
    protected $delete_group_auth_user_url = '/api/group/deleteAuthUser';
    protected $add_group_tatoo_user_url = '/api/group/createTabooUser';
    protected $delete_group_tatoo_user_url = '/api/group/deleteTabooUser';

    protected $host;
    protected $appid;
    protected $header = [];

    public function __construct(string $appid, string $host)
    {
        $this->host = $host;
        $this->appid = $appid;
        $this->header = ['appid'=>$appid];
    }

    /**
     * 创建群聊
     * @param array $from_user
     * @param string $group_name
     * @param string $avatar
     * @param int $size
     * @param string $introduction
     * @param array $group_users
     * @return mixed
     * @throws Exception
     */
    public function create(
        array $from_user,
        string $group_name,
        string $avatar,
        int $size,
        string $introduction='',
        array $group_users = []
    ){
        $request_url = $this->host.$this->group_create_rul;
        $params = [
            'from_user'=>$from_user,
            'group_name'=>$group_name,
            'avatar'=>$avatar,
            'size'=>$size,
            'introduction'=>$introduction,
            'group_users'=>$group_users
        ];
        return HttpRequest::post($request_url,$params,$this->header);
    }

    /**
     * 添加群成员
     * @param int $group_id
     * @param array $group_users
     * @return mixed
     * @throws Exception
     */
    public function addmember(int $group_id,array $group_users = [])
    {
        $params = [
            'group_id'=>$group_id,
            'group_users'=>$group_users
        ];
        $request_url = $this->host.$this->add_member_url;
        return HttpRequest::post($request_url,$params,$this->header);
    }

    /**
     * 发送消息
     * @param int $group_id
     * @param string $uniqueid
     * @param array $content
     * @return mixed
     * @throws Exception
     */
    public function sendMessage(int $group_id,string $uniqueid,array $content){
        $params = [
            'group_id'=>$group_id,
            'uniqueid'=>$uniqueid,
            'content'=>$content
        ];
        $request_url = $this->host.$this->send_message_url;
        return HttpRequest::post($request_url,$params,$this->header);
    }

    /**
     *获取群聊天记录
     * @param int $group_id
     * @param string $uniqueid
     * @param int $page
     * @param int $size
     * @return mixed
     * @throws Exception
     */
    public function getChatHistory(int $group_id, string $uniqueid, int $page=1, int $size=10){
        $params = [
            'group_id'=>$group_id,
            'uniqueid'=>$uniqueid,
            'page'=>$page,
            'size'=>$size
        ];
        $request_url = $this->host.$this->get_chat_history_url;
        return HttpRequest::get($request_url,$params,$this->header);
    }

    /**
     * 获取群成员
     * @param int $group_id
     * @return mixed
     * @throws Exception
     */
    public function getGroupRelation(int $group_id){
        $params = [
            'group_id'=>$group_id
        ];
        $request_url = $this->host.$this->get_group_relation_url;
        return HttpRequest::get($request_url,$params,$this->header);
    }

    /**
     * 获取群信息
     * @param int $group_id
     * @return mixed
     * @throws Exception
     */
    public function getGroupInfo(int $group_id){
        $params = [
            'group_id'=>$group_id
        ];
        $request_url = $this->host.$this->get_group_info_url;
        return HttpRequest::get($request_url,$params,$this->header);
    }

    /**
     * 获取已加入的群
     * @param string $uniqueid
     * @return mixed
     * @throws Exception
     */
    public function getMyGroups(string $uniqueid){
        $params = [
            'uniqueid'=>$uniqueid
        ];
        $request_url = $this->host.$this->get_my_group_url;
        return HttpRequest::get($request_url,$params,$this->header);
    }

    /**
     * 删除群成员
     * @param $group_id
     * @param $uniqueid
     * @return mixed
     * @throws Exception
     */
    public function deleteGroupUser(int $group_id, string $uniqueid)
    {
        $params = [
            'group_id'=>$group_id,
            'uniqueid'=>$uniqueid
        ];
        $request_url = $this->host.$this->delete_group_user_url;
        return HttpRequest::post($request_url,$params,$this->header);
    }

    /**
     * 添加管理员
     * @param int $group_id
     * @param string $from_uniqueid
     * @param string $to_uniqueid
     * @return mixed
     * @throws Exception
     */
    public function addGroupAuthUser(int $group_id,string $from_uniqueid,string $to_uniqueid)
    {
        $params = [
            'group_id'=>$group_id,
            'from_uniqueid'=>$from_uniqueid,
            'to_uniqueid'=>$to_uniqueid,
        ];
        $request_url = $this->host.$this->add_group_auth_user_url;
        return HttpRequest::post($request_url,$params,$this->header);
    }

    /**
     * 删除群管理员
     * @param int $group_id
     * @param string $from_uniqueid
     * @param string $to_uniqueid
     * @return mixed
     * @throws Exception
     */
    public function deleteGroupAuthUser(int $group_id,string $from_uniqueid,string $to_uniqueid){
        $params = [
            'group_id'=>$group_id,
            'from_uniqueid'=>$from_uniqueid,
            'to_uniqueid'=>$to_uniqueid,
        ];
        $request_url = $this->host.$this->delete_group_auth_user_url;
        return HttpRequest::post($request_url,$params,$this->header);
    }

    /**
     * 禁言
     * @param int $group_id
     * @param string $from_uniqueid
     * @param string $to_uniqueid
     * @return mixed
     * @throws Exception
     */
    public function addGroupTatooUser(int $group_id,string $from_uniqueid,string $to_uniqueid){
        $params = [
            'group_id'=>$group_id,
            'from_uniqueid'=>$from_uniqueid,
            'to_uniqueid'=>$to_uniqueid,
        ];
        $request_url = $this->host.$this->add_group_tatoo_user_url;
        return HttpRequest::post($request_url,$params,$this->header);
    }

    /**
     * 取消禁言
     * @param int $group_id
     * @param string $from_uniqueid
     * @param string $to_uniqueid
     * @return mixed
     * @throws Exception
     */
    public function deleteGroupTatooUser(int $group_id,string $from_uniqueid,string $to_uniqueid)
    {
        $params = [
            'group_id'=>$group_id,
            'from_uniqueid'=>$from_uniqueid,
            'to_uniqueid'=>$to_uniqueid,
        ];
        $request_url = $this->host.$this->delete_group_tatoo_user_url;
        return HttpRequest::post($request_url,$params,$this->header);
    }
}