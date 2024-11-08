<?php


namespace App;

use simplehtmldom\HtmlWeb;

class Digikala
{

    private $baseUrl = 'https://www.digikala.com/product/';
    private $id;
    private $title;
    private $image;
    private $price;
    private $html;

    // Selector
    public $title_Selector = '.c-product__title';
    public $image_Selector = '.js-gallery-img';
    public $price_Selector = '.c-product__seller-price-pure.js-price-value';


    public function __construct($productId)
    {

        $url = $this->baseUrl . $productId;
        $client = new HtmlWeb();
        $this->html = $client->load($url);
    }

    public function getTitle()
    {
        $this->title = $this->html->find($this->title_Selector, 0)->text();
        return $this->title;
    }


    public function getImage()
    {
        $this->image = $this->html->find($this->image_Selector, 0)->attr['data-src'];
        return $this->image;
    }

    public function getPrice()
    {
        $this->price = $this->html->find($this->price_Selector, 0)->text();
        return $this->price;
    }

}
