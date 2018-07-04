<?php

namespace Templates\Visitor;


abstract class Unit
{
    protected $depth = 0;

    public function getComposite()
    {
        return null;
    }
    abstract public function bombardStrength();

    protected function setDepth($depth)
    {
        $this->depth = $depth;
    }

    public function getDepth()
    {
        return $this->depth;
    }

    public function accept(ArmyVisitor $visitor)
    {
        $fullClassName = get_class($this);
        $path = explode('\\', $fullClassName);
        $className = array_pop($path);
        $method = "visit" . $className;
        $visitor->$method($this);
    }
}