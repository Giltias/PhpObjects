<?php

namespace Templates\Facade;


class ProductFacade
{
    private $file;
    private $products = [];

    public function __construct($file)
    {
        $this->file = $file;
        $this->compile();
    }

    private function compile()
    {
        $lines = getProductFileLines($this->file);
        foreach ($lines as $line) {
            $id = getIDFromLine($line);
            $name = getNameFromLine($line);
            $this->products[$id] = getProuctObjectFromID($id, $name);
        }
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function getProduct($id)
    {
        if (isset($this->products[$id])) {
            return $this->products[$id];
        }
        return null;
    }
}