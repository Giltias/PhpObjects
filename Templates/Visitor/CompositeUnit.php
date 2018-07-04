<?php

namespace Templates\Visitor;


abstract class CompositeUnit extends Unit
{
    private $units = [];

    public function getComposite()
    {
        return $this;
    }

    protected function units()
    {
        return $this->units;
    }

    public function removeUnit(Unit $unit)
    {
        $this->units = array_udiff($this->units, [$unit], function ($a, $b) {return $a === $b ? 0: 1;});
    }

    public function addUnit(Unit $unit)
    {
        foreach ($this->units as $tUnit) {
            if ($unit === $tUnit) {
                return;
            }
        }
        $unit->setDepth($this->depth+1);
        $this->units[] = $unit;
    }

    public function accept(ArmyVisitor $visitor)
    {
        parent::accept($visitor);
        foreach ($this->units as $tUnit) {
            $tUnit->accept($visitor);
        }
    }
}