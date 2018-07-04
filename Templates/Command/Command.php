<?php

namespace Templates\Command;


abstract class Command
{
    abstract function execute(CommandContext $context);
}