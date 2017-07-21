<?php
    
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 21/07/2017
     * Time: 20:20
     */
    use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
    
    
    class AppTest extends WebTestCase
    {
        /*
         * Allows to test if all routes are OK
         */
        public function testIndex()
        {
            $client = static::createClient();
            foreach($this->provideUrls() as $url)
            {
                $client->request('GET', $url);
                $this->assertTrue($client->getResponse()->isSuccessful());
            }
        }
        
        private function provideUrls()
        {
            return array('/');
        }
        
        
    }