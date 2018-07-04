<?php

namespace Templates\Observer;


class PartnershipTool extends LoginObserver
{
    function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        echo __CLASS__ . ":    Отправка cookie-файла, если адрес соответствует списку <br>";
    }

}