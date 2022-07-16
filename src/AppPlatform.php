<?php

namespace Lanyue\ImSdk;

use Lanyue\ImSdk\library\app\Application;
use Lanyue\ImSdk\library\app\User;
use Lanyue\ImSdk\library\im\Friend;
use Lanyue\ImSdk\library\im\Group;
use ReflectionClass;
use ReflectionException;

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

    public function app(string $email,string $password)
    {
        return self::invokeClass(Application::class, ['email' => $email, 'password'=>$password,'host' => $this->host]);
    }


    public function friend(string $appid)
    {
        return self::invokeClass(Friend::class,['appid'=>$appid,'host'=>$this->host]);
    }

    public function group(string $appid)
    {
        return self::invokeClass(Group::class,['appid'=>$appid,'host'=>$this->host]);
    }

    public function imUser(string $appid)
    {
        return self::invokeClass(library\im\User::class,['appid'=>$appid,'host'=>$this->host]);
    }

    /**
     * 调用反射执行类的方法 支持参数绑定
     * @access public
     * @param $class
     * @param array $vars 变量
     * @return mixed
     * @throws ReflectionException
     */
    public static function invokeClass($class, array $vars = [])
    {
        try {
            $reflect = new ReflectionClass($class);
        } catch (ReflectionException $e) {
        }

        $constructor = $reflect->getConstructor();
        if($constructor){
            try {
                return $reflect->newInstanceArgs($vars);
            } catch (ReflectionException $e) {
            }
        }
        return $reflect;
    }


    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }
}