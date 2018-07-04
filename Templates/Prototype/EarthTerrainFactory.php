<?php

namespace Templates\Prototype;


class EarthTerrainFactory extends TerrainFactory
{
    public function getSea()
    {
        return new EarthSea();
    }

    public function getPlains()
    {
        return new EarthPlain();
    }

    public function getForest()
    {
        return new EarthForest();
    }

}