<?php
namespace App\Entity;
use Symfony\Component\Config\Definition\Exception\Exception;
 
class Product{

    const FOOD_PRODUCT = 'food';
    
    public function __construct($name, $type, $price)
    {
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
    }

    public function computeTVA(): float | Exception
    {
        
        if (self::FOOD_PRODUCT == $this->type) {
            return $this->price * 0.055;
        }
    }
}