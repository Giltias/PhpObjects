<?php

namespace Templates\Interpreter;


class InterpreterContext
{
    private $expressionStore = [];

    public function replace(Expression $expression, $value)
    {
        $this->expressionStore[$expression->getKey()] = $value;
    }

    public function lookup(Expression $expression)
    {
        return $this->expressionStore[$expression->getKey()];
    }
}