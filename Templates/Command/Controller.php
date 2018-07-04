<?php

namespace Templates\Command;


class Controller
{
    private $context;

    public function __construct()
    {
        $this->context = new CommandContext();
    }

    /**
     * @return CommandContext
     */
    public function getContext()
    {
        return $this->context;
    }

    public function process()
    {
        $action = $this->context->get('action');
        $action = (null === $action) ? 'default' : $action;
        $cmd = CommandFactory::getCommand($action);
        if (!$cmd->execute($this->context)) {

        } else {

        }
    }
}