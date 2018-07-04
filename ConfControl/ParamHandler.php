<?php

namespace ConfControl;


abstract class ParamHandler
{
    protected $source;
    protected $params = [];

    function __construct($source)
    {
        $this->source = $source;
    }

    static function getinstance($filename)
    {
        if (preg_match("/\.xml$/i", $filename)) {
            return new  XmlHandler($filename);
        }
        return new TextParamHandler($filename);
    }

    function addParam($key, $val)
    {
        $this->params[$key] = $val;
    }

    function getAllParams()
    {
        return $this->params;
    }

    abstract function write();

    abstract function read();
}