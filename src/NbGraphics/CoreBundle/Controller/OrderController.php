<?php

namespace NbGraphics\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use NbGraphics\CoreBundle\Form\Type\NbTicketsType;


class OrderController extends Controller
{
    public function nbticketsAction(Request $request)
    {
        $session = $request->getSession();
        $nbBillets = array('NbBillets' => 'Nombre de billets');
        $session->set('nombre',$nbBillets);
        $form3 = $this->createForm(NbTicketsType::class);
        
        if ($request->isMethod('POST'))
        {
            $form3->handleRequest($request);
            
            if ($form3->isValid())
            {
                $data = $form3->getData();
                
                if ($data['choiceNb'] == 1)
                {
                    $data['NbBillets'] = 1;
                }
                $session->set('nombre', $data['NbBillets']);
                return $this->redirectToRoute('order');
            }
        }
        return $this->render('NbGraphicsCoreBundle:Order:nbtickets.html.twig',  array(
            'form3' => $form3->createView()));
    }
    
    
    public function orderAction(Request $request)
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
 
