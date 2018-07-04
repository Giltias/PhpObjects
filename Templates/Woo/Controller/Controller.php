<?php

namespace Templates\Woo\Controller;


use Templates\Woo\Base\ApplicationRegistry;

class Controller
{
    private $applicationHelper;
    
    private function __construct() {}

    public static function run()
    {
        $instance = new Controller();
        $instance->init();
        $instance->handleRequest();
    }

    public function init()
    {
        $applicationHelper = ApplicationHelper::instance();
        $applicationHelper->init();
    }

    public function handleRequest()
    {
        $request = ApplicationRegistry::getRequest();
        $cmd_r = new CommandResolver();
        $cmd = $cmd_r->getCommand($request);
        $cmd->execute($request);
    }
}