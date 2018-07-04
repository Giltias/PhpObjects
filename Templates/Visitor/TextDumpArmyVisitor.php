<?php

namespace Templates\Visitor;


class TextDumpArmyVisitor extends ArmyVisitor
{
    private $text;

    function visit(Unit $node)
    {
        $txt = '';
        $pad = 4*$node->getDepth();
        $txt .= sprintf("%'.{$pad}s", "");
        $fullClassName = get_class($node);
        $path = explode('\\', $fullClassName);
        $className = array_pop($path);
        $txt .= $className.": ";
        $txt .= "Огневая мощь: " . $node->bombardStrength() . "<br>";
        $this->text .= $txt;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }
}