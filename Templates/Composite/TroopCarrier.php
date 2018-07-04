<?php

namespace Templates\Composite;


class TroopCarrier extends CompositeUnit
{
    public function addUnit(Unit $unit)
    {
        if ($unit instanceof Cavalry) {
            throw new UnitException("Нельзя помещать лошадь на бронетранспортер");
        }

        super::addUnit($unit);
    }

    public function bombardStrength()
    {
        return 0;
    }

}