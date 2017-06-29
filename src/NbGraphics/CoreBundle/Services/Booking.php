<?php
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 29/06/2017
     * Time: 15:00
     */
    
    namespace NbGraphics\CoreBundle\Services;

    use Doctrine\DBAL\Types\IntegerType;
    use NbGraphics\CoreBundle\Entity\Basket;
    use NbGraphics\CoreBundle\Entity\Ticket;

    use Symfony\Component\Form\FormFactory;
    use NbGraphics\CoreBundle\Form\BasketType;
    use NbGraphics\CoreBundle\Form\TicketType;
    use Doctrine\ORM\EntityManagerInterface;
    
    use Symfony\Component\HttpFoundation\Request;
    class Booking
    {
        private $pricing;
        private $form;
        
        public function __construct(\NbGraphics\CoreBundle\Services\Pricing $pricing, FormFactory $form)
        {
            $this->pricing = $pricing;
            $this->form = $form;
        }
        
        public function setOrder($nbBillets)
        {
            $basket = new Basket(); //remplacer par un service puis regarder comment injecter un autre objet dedans
            $basket->setNbBillets($nbBillets);
            $basket->createTickets($nbBillets); // à modifier
    
            $form = $this->form->create(BasketType::class, $basket);
            return $form;
        }
    }