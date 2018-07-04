<?php

namespace Templates\Woo\Base;


/**
 * Class SessionRegistry
 * @package Templates\Woo\Base
 */
class SessionRegistry extends Registry
{
    /**
     * @var null
     */
    private static $instance = null;

    /**
     * SessionRegistry constructor.
     */
    private function __construct()
    {
        session_start();
    }

    /**
     * @return null|SessionRegistry
     */
    public static function instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $key
     *
     * @return null
     */
    protected function get($key)
    {
        if (isset($_SESSION[__CLASS__][$key])) {
            return $_SESSION[__CLASS__][$key];
        }
        return null;
    }

    /**
     * @param $key
     * @param $val
     */
    protected function set($key, $val)
    {
        $_SESSION[__CLASS__][$key] = $val;
    }

    /**
     * @param $dsn
     */
    public function setDSN($dsn)
    {
        self::instance()->set('dsn', $dsn);
    }

    /**
     *
     */
    public function getDSN()
    {
        self::instance()->get('dsn');
    }
}