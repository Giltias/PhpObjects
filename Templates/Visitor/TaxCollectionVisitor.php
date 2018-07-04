<?php

namespace Templates\Visitor;


class TaxCollectionVisitor extends ArmyVisitor
{
    private $due = 0;
    private $report = '';

    public function visit(Unit $node)
    {
        $this->levy($node ,1);
    }

    public function visitArcher(Archer $node)
    {
        $this->levy($node, 2);
    }

    public function visitCavalry(Cavalry $node)
    {
        $this->levy($node, 3);
    }

//    public function visitLaserCannonUnit(LaserCannonUnit $node)
//    {
//        $this->levy($node);
//
//    }

    public function visitTroopCarrierUnit(TroopCarrier $node)
    {
        $this->levy($node, 5);

    }

//    public function visitArmy(Army $node)
//    {
//        $this->levy($node);
//    }

    private function levy(Unit $unit, $amount)
    {
        $fullClassName = get_class($node);
        $path = explode('\\', $fullClassName);
        $className = array_pop($path);
        $this->report .= "Налог для " . $className;
        $this->report .= ": $amount<br>";
        $this->due += $amount;
    }

    public function getReport()
    {
        return $this->report;
    }

    public function getTax()
    {
        return $this->due;
    }
}