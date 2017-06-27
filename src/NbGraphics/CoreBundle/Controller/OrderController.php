<?php

namespace NbGraphics\CoreBundle\Controller;

use NbGraphics\CoreBundle\Entity\Basket;
use NbGraphics\CoreBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function OrderAction(Request $request)
    {
        $session = $request->getSession();
        $basket = new Basket();
        $ticket = new Ticket();
        
        
        return $this->render('NbGraphicsCoreBundle:Order:order.html.twig');
    }
}
