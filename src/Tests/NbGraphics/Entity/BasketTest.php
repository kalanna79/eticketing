<?php
    
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 18/07/2017
     * Time: 07:32
     */
    namespace NbGraphics\CoreBundle\Tests\Entity;
    
    use NbGraphics\CoreBundle\Entity\Basket;
    use PHPUnit\Framework\TestCase;
    
    class BasketTest extends TestCase
    {
        public function testName()
        {
         $basket = new Basket();
         $basket->setName('NOEL');
         $basket->setTickets(3);
         
         $this->assertEquals('NOEL', $basket->getName());
         $this->assertEquals(3, $basket->getTickets());
        }
    }