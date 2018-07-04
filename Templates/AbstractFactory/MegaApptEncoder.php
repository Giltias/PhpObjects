<?php

namespace Templates\AbstractFactory;


class MegaApptEncoder extends ApptEncoder
{
    public function encode()
    {
        return "Данные о встрече закодированы в формате MegaCal <br />";
    }
}