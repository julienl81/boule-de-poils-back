<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{

    /**
     * @dataProvider pricesForFoodProduct
     */
    public function testcomputeTVAFoodProduct($price, $expectedTva)
    {
        $product = new Product('Un produit', Product::FOOD_PRODUCT, $price);
        $this->assertSame($expectedTva, $product->computeTVA());
    }
    public function pricesForFoodProduct()
    {
        return [
            [0, 0.0],
            [20, 1.1],
            [100, 5.5]
        ];
    }

    // public function testcomputeTVAFoodProduct()
    // {
    //     $product = new Product('Un produit', Product::FOOD_PRODUCT, 20);
    //     $this->assertSame(1.1, $product->computeTVA());
    // }

    public function testcomputeTVAFoodProductNotFood()
    {
        $product = new Product('iPhone', 'Electronique', 500);
        $this->assertSame(98.0, $product->computeTVA());
    }

    public function testNegativePriceComputeTVA()
    {
        $product = new Product('Un produit', Product::FOOD_PRODUCT, -20);
        $this->expectException('Exception');
        $product->computeTVA();
    }
}
