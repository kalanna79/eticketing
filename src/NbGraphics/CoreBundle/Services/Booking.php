<?php
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 29/06/2017
     * Time: 15:00
     */
    
    namespace NbGraphics\CoreBundle\Services;

    use NbGraphics\CoreBundle\Entity\Basket;
    use NbGraphics\CoreBundle\Entity\Ticket;

    use Symfony\Component\Form\FormFactory;
    use NbGraphics\CoreBundle\Form\Type\BasketType;
    use Doctrine\ORM\EntityManagerInterface;
    
    use Symfony\Component\HttpFoundation\Request;
    class Booking
    {
        private $pricing;
        private $form;
        private $em;
    
        /**
         * Booking constructor.
         * @param Pricing                $pricing
         * @param FormFactory            $form
         * @param EntityManagerInterface $em
         */
        public function __construct(\NbGraphics\CoreBundle\Services\Pricing $pricing,
                                    FormFactory $form,
                                    EntityManagerInterface $em)
        {
            $this->pricing = $pricing;
            $this->form = $form;
            $this->em = $em;
        }
    
        /**
         * Allow to set order form with the right number of tickets and validate it
         *
         * @param         $nbBillets
         * @param Request $request
         * @return \Symfony\Component\Form\FormInterface
         */
        public function setOrder($nbBillets, Request $request)
        {
    
            $session = $request->getSession();
          
            $tickets = $this->addTickets($nbBillets);
            $basket = new Basket();
            $basket->createTickets($tickets);
    
            $form = $this->form->create(BasketType::class, $basket);
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid())
            {
                $data = $form->getData();
                $this->Total($data);
                $this->em->persist($data);
                $this->em->flush();
                $session->set('panier', $basket->getId());
                dump($session);
            }
            return $form;
        }
    
        /**
         * Allow to add the right number of tickets forms in the basket
         * @param $nbBillets
         * @return array
         */
        public function addTickets($nbBillets)
        {
            $tickets = [];
            for ($i = 1; $i <= $nbBillets; $i++)
            {
                $tickets[$i] = new Ticket();
            }
            return $tickets;
        }
    
        /**
         * Allow to calculate the total of the basket
         * @param $basket
         */
        public function total(Basket $basket)
        {
            $tickets = $basket->getTickets();
            $total = $basket->getTotal();
    
            foreach ($tickets as $ticket)
            {
                $visit = $ticket->getVisitdate();
                $visit = $visit->format('d-m-Y');
                $age = $this->pricing->howOld($ticket->getBirthday(), $ticket->getVisitdate());
                $tarif = $this->pricing->tarif($age, $ticket->getReduction());
                $price = $this->pricing->oneTicketPrice($tarif, $ticket->getDuration());
                $ticket->setPrice($price);
                $total += $price;
                $basket->setTotal($total);
            }
        }
    }
      