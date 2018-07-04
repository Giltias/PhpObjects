<?php

namespace Templates\Visitor;


class Army extends CompositeUnit
{

    public function bombardStrength()
    {
        $ret = 0;
        /**
         * @var $unit Unit
         */
        $units = $this->units();
        foreach ($units as $unit) {
            $ret += $unit->bombardStrength();
        }
        return $ret;
    }
}