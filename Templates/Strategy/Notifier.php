<?php

namespace Templates\Strategy;


abstract class Notifier
{
    public static function getNotifier()
    {
        if (mt_rand(1, 2) === 1) {
            return new MailNotifier();
        }
        return new TextNotifier();
    }

    abstract public function inform($message);
}