<?php

namespace Templates\Strategy;


abstract class CostStrategy
{
    abstract public function cost(Lesson $lesson);
    abstract public function chargeType();
}