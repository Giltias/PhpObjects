<?php

namespace Templates\Woo\Base;


use Templates\Woo\Controller\Request;

class ApplicationRegistry extends Registry
{
    private static $instance = null;
    private $freezeDir = 'data';
    private $values = [];
    private $mTimes = [];

    private function __construct() {}

    public static function instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get($key)
    {
        $path = $this->freezeDir . DIRECTORY_SEPARATOR . $key;
        if (file_exists($path)) {
            clearstatcache();
            $mTime = filemtime($path);
            if (!isset($this->mTimes[$key])) {
                $this->mTimes[$key] = 0;
            }
            if ($mTime > $this->mTimes[$key]) {
                $data = file_get_contents($path);
                $this->mTimes[$key] = $mTime;
                return ($this->values[$key] = unserialize($data));
            }
        }
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
        return null;
    }

    protected function set($key, $val)
    {
        $this->values[$key] = $val;
        $path = $this->freezeDir . DIRECTORY_SEPARATOR . $key;
        file_put_contents($path, serialize($val));
        $this->mTimes[$key] = time();
    }

    /**
     * @param $dsn
     */
    public static function setDSN($dsn)
    {
        self::instance()->set('dsn', $dsn);
    }

    /**
     *
     */
    public static function getDSN()
    {
        self::instance()->get('dsn');
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