<?php

namespace NbGraphics\CoreBundle\Controller;

use NbGraphics\CoreBundle\Entity\Basket;
use NbGraphics\CoreBundle\Entity\Ticket;
use Symfony\Component\Validator\Constraints\DateTime;
use NbGraphics\CoreBundle\Form\BasketType;
use NbGraphics\CoreBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function OrderAction(Request $request)
    {
    
        $session = $request->getSession();
        $nbBillets = $session->get('nombre');
        $basket = $this->get('nb_graphics_core.booking')->setOrder($nbBillets);
        if ($request->isMethod('POST'))
        {
            $basket->handleRequest($request);
        
            if ($basket->isSubmitted() && $basket->isValid())
            {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($basket);
                $em->flush();
            
                return $basket;
            }
    
    
        }
    
         return $this->render('NbGraphicsCoreBundle:Order:order.html.twig',  array(
        'form' => $basket->createView()));;
    
    }
}
