<?php

namespace Templates\AbstractFactory;


class BloggsApptEncoder extends ApptEncoder
{
    public function encode()
    {
        return "Данные о встрече закодированы в формате BloggsCal <br />";
    }

}