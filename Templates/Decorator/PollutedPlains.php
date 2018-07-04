<?php

namespace Templates\Decorator;


class PollutedPlains extends Plains
{
    public function getWealthFactor()
    {
        return parent::getWealthFactor() - 4;
    }
}