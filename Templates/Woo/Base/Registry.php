<?php

namespace Templates\Woo\Base;


abstract class Registry
{
    abstract protected function get($key);
    abstract protected function set($key, $val);
}