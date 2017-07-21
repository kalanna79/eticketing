<?php
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 18/07/2017
     * Time: 08:30
     */
    
    namespace NbGraphics\CoreBundle\Tests\Services;

    use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

    class PricingTest extends KernelTestCase
    {
        
        protected function setUp()
        {
            self::bootKernel();
            $this->service = self::$kernel->getContainer()->get('nb_graphics_core.pricing');
        }
    
        /**
         * test if calculate age is ok
         * $birthday = birth date of user
         * $visitdate = date of order
         */
        public function testAge()
        {
            $birthday = new \DateTime('11-06-1979');
            $visitdate = new \DateTime();
            
            $this->assertEquals(38, $this->service->howOld($birthday, $visitdate));
        }
    
        /**
         * test if calculate price is ok
         * $tranches : array of differents ages
         * $tarifs : array ok differents prices
         * for each age in array, assert equals to price : $tranches[0] => $tarifs[0], $tranches[1] => $tarifs[1]...
         * For reduced rate, take $tranche[2] (adult price) and look if reduction is ok, when reduction==true
         */
        
        public function testTarifWithAge()
        {
            $tranches = ['0' => 2, '1' => 8, '2' => 40, '3' => 76];
            $tarifs = ['0' => 0, '1' => 8, '2' => 16, '3' => 12];
            
            $count = count($tranches);
            
            for ($i = 0; $i < $count; $i++)
            {
                $this->assertEquals($tarifs[$i], $this->service->tarif($tranches[$i], false));
            }
           $this->assertEquals(10, $this->service->tarif($tranches['2'], true));
        }
    
    
        /**
         * test if price is divided by 2 when duration == 2
         */
        public function testDuration()
        {
            $normaltarifs = [8, 16, 12];
            $demitarifs = [4, 8, 6];
            
            foreach ($normaltarifs as $tarif)
            {
                $this->assertEquals($tarif, $this->service->oneTicketPrice($tarif, '1'));
            }
            
            $count = count($demitarifs);
            $duration = '2';
    
            for ($i = 0; $i < $count; $i++)
            {
                $this->assertEquals($demitarifs[$i], $this->service->oneTicketPrice($normaltarifs[$i], $duration));
            }
        }
    
        protected function tearDown()
        {
            parent::tearDown();
        }
    }
    