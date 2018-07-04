<?php

namespace Templates\AbstractFactory;


abstract class CommsManager
{
    const APPT = 1;
    const TTD = 2;
    const CONTACT = 3;

    abstract public function getHeaderText();
    abstract public function make($flag_int);
    abstract public function getFooterText();
}