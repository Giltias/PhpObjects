<?php

namespace Templates\Woo\Base;


use Templates\Woo\Controller\Request;

class RequestRegistry extends Registry
{
    private static $instance = null;
    private $values = [];

    private function __construct() {}

    public static function instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
        return null;
    }

    protected function set($key, $val)
    {
        $this->values[$key] = $val;
    }

    public static function getRequest()
    {
        $inst = self::instance();
        if (null === $inst->get('request')) {
            $inst->set('request', new Request());
        }
        return $inst->get('request');
    }
}