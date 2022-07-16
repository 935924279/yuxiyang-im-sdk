<?php

namespace Lanyue\ImSdk;

class Base
{
    /**
     * 服务提供者
     * @var array
     */
    private $providers = [
        'group'      => 'library\\im\\Group',
        'imuser'   => 'library\\im\\User',
        'friend'  => 'library\\im\\Friend',
        'appuser' => 'library\\app\\User',
        'app' => 'library\\app\\Application',
    ];
    /**
     * 服务对象信息
     * @var array
     */
    protected $services = [];

    protected $config = [];
    public function __construct($options = [])
    {
        $options = array_intersect_key($options, $this->providers);
        $options = array_merge($this->config, is_array($options) ? $options : []);
        $this->config = $options;

        //注册服务器提供者
        $this->registerProviders();
    }
//
//    public function appuser()
//    {
//        return ;
//    }
//
//    public function app(string $email,string $password)
//    {
//        return ;
//    }
//
//
//    public function friend(string $appid)
//    {
//        return ;
//    }
//
//    public function group(string $appid)
//    {
//        return ;
//    }
//
//    public function imUser(string $appid)
//    {
//        return ;
//    }

    /**
     * 注册服务提供者
     */
    private function registerProviders()
    {
        foreach ($this->providers as $k => $v) {
            $this->services[$k] = function () use ($k, $v) {
                $options = $this->config[$k];
                $objname = __NAMESPACE__ . "\\{$v}";
                return new $objname($options);
            };
        }
    }

    public function __set($key, $value)
    {
        $this->services[$key] = $value;
    }

    public function __get($key)
    {
        return isset($this->services[$key]) ? $this->services[$key]($this) : null;
    }
}