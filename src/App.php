<?php

namespace Lanyue\ImSdk;

use Lanyue\ImSdk\library\app\Application;
use Lanyue\ImSdk\library\app\User;

class App
{

    public $host;

    public $port;

    public function __construct(string $host, int $port=80)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function appuser(){
        return  self::invokeClass(User::class,['host'=>$this->host,'port'=>$this->port]);
    }

    public function app(){
        return self::invokeClass(User::class,['host'=>$this->host,'port'=>$this->port]);
    }

     /**
     * 调用反射执行类的方法 支持参数绑定
     * @access public
     * @param string|array $method 方法
     * @param array        $vars   变量
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