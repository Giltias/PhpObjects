<?php

namespace Templates\Woo\Command;


use Templates\Woo\Controller\Request;

class CommandResolver
{
    private static $base_cmd = null;
    private static $default_cmd = null;

    public function __construct()
    {
        if (null === self::$base_cmd) {
            self::$base_cmd = new \ReflectionClass('\Templates\Woo\Command\Command');
            self::$default_cmd = new DefaultCommand();
        }
    }

    public function getCommand(Request $request)
    {
        $cmd = $request->getProperty('cmd');
        $sep = DIRECTORY_SEPARATOR;
        if (!$cmd) {
            return self::$default_cmd;
        }
        $cmd = str_replace(['.', $sep], '', $cmd);
        $filepath = 'Woo{$sep}Command{$sep}{$cmd}.php';
        $classname = 'Templates\\Woo\\Command\\$cmd';
        if (file_exists($filepath)) {
            @require($filepath);
            if (class_exists($classname)) {
                $cmd_class = new \ReflectionClass($classname);
                if ($cmd_class->isSubclassOf(self::$base_cmd)) {
                    return $cmd_class->newInstance();
                } else {
                    $request->addFeedback("Объект Command команды '$cmd' не найден");
                }
            }
        }
        $request->addFeedback("Команда '$cmd' не найдена");
        return clone self::$default_cmd;
    }
}