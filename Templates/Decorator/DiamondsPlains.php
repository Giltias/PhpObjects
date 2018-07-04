<?php

namespace Templates\Decorator;


class DiamondsPlains extends Plains
{
    public function getWealthFactor()
    {
        return parent::getWealthFactor() + 2;
    }
}