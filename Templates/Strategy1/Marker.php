<?php

namespace Templates\Strategy1;


abstract class Marker
{
    protected $test;

    public function __construct($test)
    {
        $this->test = $test;
    }

    abstract function mark($response);
}