<?php

namespace Lanyue\ImSdk;

use Lanyue\ImSdk\library\app\Application;
use Lanyue\ImSdk\library\app\User;

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