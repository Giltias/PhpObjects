<?php

namespace Templates\Observer;


class GeneralLogger extends LoginObserver
{
    function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        echo __CLASS__ . ":    Регистрация в системном журнале <br>";
    }

}