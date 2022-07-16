<?php

namespace Lanyue\ImSdk;

use Lanyue\ImSdk\library\app\Application;
use Lanyue\ImSdk\library\app\User;
use Lanyue\ImSdk\library\im\Friend;
use Lanyue\ImSdk\library\im\Group;

class AppPlatform
{

    public $host;


    public function __construct(string $host)
    {
        $this->host = $host;

    }

    public function appuser()
    {
        return self::invokeClass(User::class, ['host' => $this->host]);
    }

    public function app($token)
    {
        return self::invokeClass(Application::class, ['token' => $token, 'host' => $this->host]);
    }


    public function friend($appid)
    {
        return self::invokeClass(Friend::class,['appid'=>$appid,'host'=>$this->host]);
    }

    public function group($appid)
    {
        return self::invokeClass(Group::class,['appid'=>$appid,'host'=>$this->host]);
    }

    public function imUser($appid)
    {
        return self::invokeClass(\Lanyue\ImSdk\library\im\User::class,['appid'=>$appid,'host'=>$this->host]);
    }
    /**
     * 调用反射执行类的方法 支持参数绑定
     * @access public
     * @param string|array $method 方法
     * @param array $vars 变量
     * @return mixed
     */
    public static function invokeClass($class, $vars = [])
    {
        $reflect = new \ReflectionClass($class);

        $constructor = $reflect->getConstructor();
        if($constructor){
            return $reflect->newInstanceArgs($vars);
        }
        return $reflect;
    }


    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }
}