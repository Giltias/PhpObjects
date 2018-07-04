<?php

namespace Templates\Woo\Controller;


use Templates\Woo\Base\ApplicationRegistry;

class ApplicationHelper
{
    private static $instance = null;
    private $config = 'data/woo_options.xml';

    private function __construct() {}

    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function init()
    {
        $dsn = ApplicationRegistry::getDSN();
        if (null !== $dsn) {
            return;
        }
        $this->getOptions();
    }

    private function getOptions()
    {
        $this->ensure(file_exists($this->config), 'Файл конфигурации не найден');
        $options = @simplexml_load_string(file_get_contents($this->config));
        $dsn = (string)$options->dsn;
        $this->ensure($options instanceof \SimpleXMLElement, 'Файл конфигурации испорчен');
        $this->ensure($dsn, 'DSN не найден');
        ApplicationRegistry::setDSN($dsn);
    }

    private function ensure($expr, $message)
    {
        if (!$expr) {
            throw new AppException($message);
        }
    }
}