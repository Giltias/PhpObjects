<?php

namespace Templates\FactoryMethod;


class MegaCommManager extends CommsManager
{
    public function getHeaderText()
    {
        return "MegaCal верхний колонтитул <br />";
    }

    public function getApptEncoder()
    {
        return new MegaApptEncoder();
    }

    public function getFooterText()
    {
        return "MegaCal нижний колонтитул <br />";
    }
}