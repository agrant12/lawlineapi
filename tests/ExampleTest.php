<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {   
        $response = $this->call('GET', 'api/v1/users');
       
        $this->assertEquals(200, $response->status());
    }

    public function test2() {
        $createProduct = $this->call('GET', 'api/v1/allproducts');
        $this->assertEquals(200, $createProduct->status());
    }


}

?>

