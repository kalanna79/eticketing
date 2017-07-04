<?php

namespace NbGraphics\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function OrderAction(Request $request)
    {
    
        $session = $request->getSession();
        $nbBillets = $session->get('nombre');
        $basket = $this->get('nb_graphics_core.booking')->setOrder($nbBillets, $request);
        if ($basket->isSubmitted() && $basket->isValid())
        {
            return $this->redirectToRoute('recap');
        }
        
         return $this->render('NbGraphicsCoreBundle:Order:order.html.twig',  array(
        'form' => $basket->createView()));
    }
}
