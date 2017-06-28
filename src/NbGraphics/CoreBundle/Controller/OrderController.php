<?php

namespace NbGraphics\CoreBundle\Controller;

use NbGraphics\CoreBundle\Entity\Basket;
use NbGraphics\CoreBundle\Entity\Ticket;

use NbGraphics\CoreBundle\Form\BasketType;
use NbGraphics\CoreBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function OrderAction(Request $request)
    {
        $basket = new Basket();
        $basket->setStatus('en cours');
        $session = $request->getSession();
        $nbBillets = $session->get('nombre');
        $basket->setNbBillets($nbBillets);

    
        for ($i = 1; $i <= $nbBillets; $i++) {
            $ticket[$i] = new Ticket();
            $ticket[$i]->setBasket($basket);
            $basket->addTicket($ticket[$i]);
        }
    
        $form = $this->createForm(BasketType::class, $basket);
    
    
        if ($request->isMethod('POST'))
            {
                dump($basket);
                $form->handleRequest($request);
                
                if ($form->isSubmitted() && $form->isValid())
                {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($basket);
    
                    $em->flush();
                    dump($basket);exit;
    
    
                    return $this->redirectToRoute('duration');
                }
            }
        
    
        return $this->render('NbGraphicsCoreBundle:Order:order.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
