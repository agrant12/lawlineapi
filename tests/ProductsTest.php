<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test2() {
        $getProduct = $this->call('GET', 'api/v1/allproducts');
        $this->assertEquals(200, $getProduct->status());
    }

    public function test3() {
        $getProduct = $this->call('GET', 'api/v1/product/1');
        $this->assertEquals(200, $getProduct->status());
    }
}

?>

