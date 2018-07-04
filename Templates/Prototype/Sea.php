<?php

namespace Templates\Prototype;


class Sea
{
    private $navigability = 0;

    public function __construct($navigability)
    {
        $this->navigability = $navigability;
    }

}