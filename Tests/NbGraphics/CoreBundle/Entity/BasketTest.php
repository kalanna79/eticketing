<?php
    
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 18/07/2017
     * Time: 07:32
     */
    namespace Tests\NbGraphics\CoreBundle\Entity;
    
    use NbGraphics\CoreBundle\Entity\Basket;
    use PHPUnit\Framework\TestCase;
    
    class BasketTest extends TestCase
    {
        public function NameTest()
        {
         $basket = new Basket();
         $name = $basket->setName('noel');
         
         $this->assertEquals('noel', $name);
        }
    }