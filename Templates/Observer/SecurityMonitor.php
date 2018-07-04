<?php

namespace Templates\Observer;


class SecurityMonitor extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            echo __CLASS__ . ":    Отправка почты системному администратору <br>";
        }
    }
}