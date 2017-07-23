<?php
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 23/07/2017
     * Time: 17:18
     */
    
    namespace Tests\NbGraphics\Controller;
    
    use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

    class OrderControllerTest extends WebTestCase
    {
    
        /*
         * test if form for nbtickets is ok
         * Test with  nb tickets = 3 (user + 2 others persons)
         */
        public function testNbTicketsFr()
        {
            $client = static::createClient();
            $crawler = $client->request('GET', '/fr/nbtickets');
            $this->assertEquals('NbGraphics\CoreBundle\Controller\OrderController::nbticketsAction', $client->getRequest()->attributes->get('_controller'));
        
            $form = $crawler->selectButton('Suivant')->form(array('nb_tickets[choiceNb]' => '2',
                'nb_tickets[NbBillets]' => '2'));
            $client->submit($form);
            $this->assertEquals('NbGraphics\CoreBundle\Controller\OrderController::nbticketsAction', $client->getRequest()->attributes->get('_controller'));
        }
    }
    
