<?php

namespace Templates\Interpreter;


abstract class OperatorExpression extends Expression
{
    protected $l_op;
    protected $r_op;

    public function __construct(Expression $l_op, Expression $r_op)
    {
        $this->l_op = $l_op;
        $this->r_op = $r_op;
    }

    public function interpret(InterpreterContext $context)
    {
        $this->l_op->interpret($context);
        $this->r_op->interpret($context);
        $result_l = $context->lookup($this->l_op);
        $result_r = $context->lookup($this->r_op);
        $this->doInterpret($context, $result_l, $result_r);
    }

    protected abstract function doInterpret(InterpreterContext $context, $result_l, $result_r);
}