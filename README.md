# yuxiyang-im-sdk


## 安装方法
  `composer require lanyue/yuxiyang-im-sdk`
## 简介
<font size=4 >此sdk对应的是一个聊天平台，分为平台端,im端，im分为api,和websocket</font>
## 请求示例
### 平台端
#### 应用
   ```php
    use Lanyue\ImSdk\AppPlatform;
    $host = "http://127.0.0.1:9501"; //请求地址
    $email = '935924279@qq.com'; //邮箱
    $password = '123456';//你的密码
    $platform =  new AppPlatform($host);

    //获取已经创建的应用 getapp
    $apps = $platform->app($email,$password)->getapp();

    //创建app createApp
    $appName = '你的app名称';//你的app名称
    $appDes = '你的app描述';//你的app描述
    $app = $platform->app($email,$password)->createApp($appName,$appDes);
   ```
### IM接口
#### 单聊
   ```php
    use Lanyue\ImSdk\AppPlatform;
    $host = "http://127.0.0.1:9501"; //请求地址
    $platform =  new AppPlatform($host);
    $appid = 'qlSldg';//平台生成的应用ID
    
    //创建应用 createChat
    $from_user = [//发起聊天用户信息
        "uniqueid"=>"935924279",//自己用户的唯一标识
        "username"=>"试试就试试",//名称
        "avatar"=>""//头像
    ];
    $to_user = [
        "uniqueid"=>"yuxiyang",
        "username"=>"试试就试试",
        "avatar"=>""
    ];
    $platform->friend($appid)->createChat($from_user,$to_user);

    //发送消息 sendMessage
    $friend_group_id = 7; 单聊标识
    $uniqueid = 'yuxiyang';//自己用户的唯一标识
    $content = ['msg'=>'teset'];//你要发送的消息内容,消息内容自定义
    $platform->friend($appid)->sendMessage(7,$uniqueid,$content);
    
    //用户单聊列表 appList
    $page=1;$size=10;
    $platform->friend($appid)->appList($uniqueid,$page,$size);
    
    //单聊记录 getChatHistory
    $platform->friend($appid)->getChatHistory($friend_group_id,$uniqueid,$page,$size);
   ```
#### 群聊
   ```php
    use Lanyue\ImSdk\AppPlatform;
    $host = "http://127.0.0.1:9501"; //请求地址
    $platform =  new AppPlatform($host);
    $appid = 'qlSldg';//平台生成的应用ID
    
    //创建群聊 create
     $from_user = [//用户信息
        "uniqueid"=>"935924279",//自己用户的唯一标识
        "username"=>"试试就试试",//名称
        "avatar"=>""//头像
    ];
    $group_name = '群名称';
    $group_name = '群头像';
    $size = '群人数';
    $introduction = '群介绍';
    $group_users = [//添加的群成员
        {
            "uniqueid":"12343456",
            "username":"试试就试试",
            "avatar":""
        } ...
    ]
    $platform->group($appid)->create($from_user,$group_name,$group_name);
    
    //添加群成员 addmember
    $group_id = 1;//群ID
    $platform->group($appid)->addmember($group_id,$group_users);
    
    //发送群消息 sendMessage
     $uniqueid = 'yuxiyang';//自己用户的唯一标识
     $content = ['msg'=>'teset'];//你要发送的消息内容,消息内容自定义
    $platform->group($appid)->sendMessage($group_id,$uniqueid,$content);
    
    //群聊天记录 getChatHistory
    $page =1;$size = 10;
    $platform->group($appid)->getChatHistory($group_id,$uniqueid,$page,$size);
    
    //获取群成员 getGroupRelation
    $platform->group($appid)->getGroupRelation($group_id);
    
    //获取群信息 getGroupInfo
    $platform->group($appid)->getGroupInfo($group_id);
    
    //获取已经加入的群 getMyGroups
    $platform->group($appid)->getMyGroups($uniqueid);
    
    //删除群成员 deleteGroupUser
    $platform->group($appid)->deleteGroupUser($group_id,$uniqueid);
    
    --------------------------------------------------------------------------------------------------
    //管理员管理及操作管理
    $from_uniqueid = '935924279';//操作人的唯一标识
    $to_uniqueid = ''//被操作人的唯一标识
    
    //添加管理员 addGroupAuthUser
    $platform->group($appid)->addGroupAuthUser($group_id,$from_uniqueid,$to_uniqueid);
    
    //删除管理员 deleteGroupAuthUser
    $platform->group($appid)->deleteGroupAuthUser($group_id,$from_uniqueid,$to_uniqueid);
    
    //禁言 addGroupTatooUser
    $platform->group($appid)->addGroupTatooUser($group_id,$from_uniqueid,$to_uniqueid);
    
    //取消禁言 deleteGroupTatooUser
    $platform->group($appid)->deleteGroupTatooUser($group_id,$from_uniqueid,$to_uniqueid);
    
   ```
#### 用户 链接websocket时需要token
   ```php
    use Lanyue\ImSdk\AppPlatform;
    $host = "http://127.0.0.1:9501"; //请求地址
    $platform =  new AppPlatform($host);
    $appid = 'qlSldg';//平台生成的应用ID

    //websocket token
     $from_user = [//用户信息
        "uniqueid"=>"935924279",//自己用户的唯一标识
        "username"=>"试试就试试",//名称
        "avatar"=>""//头像
    ];
    $platform->imUser($appid)->websocket($from_user);
   ```
### websocket
   ```php
   //链接
   $token = '';//im->用户 获取的token
   ws://127.0.0.1:9502/?token={$token}
   
   //心跳
   {"cmd":"user.ping","data":{},"ext":{}}
   
   ```