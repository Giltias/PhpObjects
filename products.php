<?php

class Product
{
    public $name;
    public $price;

    public function __construct($name, $price)
    {
        $this->name  = $name;
        $this->price = $price;
    }
}

class ProcessSale
{
    private $callbacks;

    public function registerCallback($callback) {
        if (!is_callable($callback)) {
            throw new Exception('Функция обратного вызова - невызываемая');
        }

        $this->callbacks[] = $callback;
    }

    public function sale(Product $product)
    {
        print "{$product->name}: обрабатывается... <br>";
        foreach ($this->callbacks as $callback) {
            call_user_func($callback, $product);
        }
    }
}

class Mailer
{
    public function doMail($product) {
        print " Упаковываем ({$product->name})<br>";
    }

}

class Totalizer
{
    public static function warnAmount($amt)
    {
        $count=0;
        return function ($product) use ($amt, &$count) {
            $count += $product->price;
            print " сумма: $count<br>";

            if ($count > $amt) {
                print " Продано товаров на сумму: {$count}<br>";
            }
        };
    }
}

$logger = function ($product) {
    print " Записываем... ({$product->name})<br>";
};
$processor = new ProcessSale();
$processor->registerCallback($logger);
$processor->registerCallback([new Mailer(), "doMail"]);
$processor->registerCallback(Totalizer::warnAmount(8));
$processor->sale(new Product('Туфли', 6));
print "<br>";
$processor->sale(new Product('Кофе', 6));
