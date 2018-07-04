<?php

namespace Templates\Strategy;


class FixedCostStrategy extends CostStrategy
{
    public function cost(Lesson $lesson)
    {
        return 30;
    }

    public function chargeType()
    {
        return 'Фиксированная ставка';
    }
}