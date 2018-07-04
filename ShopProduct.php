<?php

interface Chargeable
{
    public function getPrice();
}

/**
 * Class ShopProduct
 */
class ShopProduct implements Chargeable
{
    use PriceUtilities, IdentityTrait;
    /**
     * @var
     */
    protected $price;
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $producerMainName;
    /**
     * @var
     */
    private $producerFirstName;
    /**
     * @var int
     */
    private $discount = 0;

    /**
     * ShopProduct constructor.
     *
     * @param $title
     * @param $firstName
     * @param $mainName
     * @param $price
     */
    public function __construct($title, $firstName, $mainName, $price)
    {
        $this->title = $title;
        $this->producerFirstName = $firstName;
        $this->producerMainName = $mainName;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getProducerMainName()
    {
        return $this->producerMainName;
    }

    /**
     * @return mixed
     */
    public function getProducerFirstName()
    {
        return $this->producerFirstName;
    }

    /**
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param $num
     */
    public function setDiscount($num)
    {
        $this->discount = $num;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return ($this->price - $this->discount);
    }

    /**
     * @return string
     */
    public function getProducer()
    {
        return "{$this->producerFirstName} {$this->producerMainName}";
    }

    /**
     * @return string
     */
    public function getSummaryLine()
    {
        return "$this->title ( {$this->producerMainName}, {$this->producerFirstName} )";
    }
}

/**
 * Class CDProduct
 */
class CDProduct extends ShopProduct
{
    /**
     * @var
     */
    private $playLength;

    /**
     * CDProduct constructor.
     *
     * @param $title
     * @param $firstName
     * @param $mainName
     * @param $price
     * @param $playLength
     */
    public function __construct($title, $firstName, $mainName, $price, $playLength)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLength = $playLength;
    }

    /**
     * @return mixed
     */
    public function getPlayLength()
    {
        return $this->playLength;
    }

    /**
     * @return string
     */
    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": Время звучания - {$this->playLength}";
        return $base;
    }
}

/**
 * Class BookProduct
 */
class BookProduct extends ShopProduct
{
    /**
     * @var
     */
    private $numPages;

    /**
     * BookProduct constructor.
     *
     * @param $title
     * @param $firstName
     * @param $mainName
     * @param $price
     * @param $numPages
     */
    public function __construct($title, $firstName, $mainName, $price, $numPages)
    {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }

    /**
     * @return mixed
     */
    public function getNumberOfPages()
    {
        return $this->numPages;
    }

    /**
     * @return string
     */
    public function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": {$this->numPages} стр.";
        return $base;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
}

/**
 * Class ShopProductWriter
 */
abstract class ShopProductWriter
{
    /**
     * @var array
     */
    protected $products = [];

    /**
     * @param ShopProduct $shopProduct
     */
    public function addProduct(ShopProduct $shopProduct)
    {
        $this->products[] = $shopProduct;
    }

    /**
     * @return mixed
     */
    abstract public function write();
//    {
//        $str = '';
//        /**
//         * @var $product ShopProduct
//         */
//        foreach ($this->products as $product) {
//            $str .= "{$product->getTitle()}: ";
//            $str .= $product->getProducer();
//            $str .= " ({$product->getPrice()})\n";
//        }
//    }
}

class XmlProductWriter extends ShopProductWriter
{
    public function write()
    {
        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');

        $writer->startElement('products');

        /**
         * @var $product ShopProduct
         */
        foreach ($this->products as $product) {
            $writer->startElement('product');
            $writer->writeAttribute('title', $product->getTitle());
            $writer->startElement('summary');
            $writer->text($product->getSummaryLine());
            $writer->endElement();
            $writer->endElement();
        }

        $writer->endElement();
        $writer->endDocument();
        print $writer->flush();
    }
}

class TextProductWriter extends ShopProductWriter
{
    public function write()
    {
        $str = "ТОВАРЫ:\n";
        /**
         * @var $product ShopProduct
         */
        foreach ($this->products as $product) {
            $str .= $product->getSummaryLine() . "\n";
        }
        print $str;
    }

}

trait PriceUtilities
{
    private $taxrate = 17;

    public function calculateTax($price)
    {
        return (($this->taxrate / 100) * $price);
    }
}

trait IdentityTrait
{
    public function generateId()
    {
        return uniqid('', true);
    }
}