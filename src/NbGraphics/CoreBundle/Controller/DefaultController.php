<?php

namespace NbGraphics\CoreBundle\Controller;

use NbGraphics\CoreBundle\Form\NbTicketsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
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
                $em = $this->getDoctrine()->getManager();
                $data = $form3->getData();
                
                if ($data['choiceNb'] == 1)
                {
                    $data['NbBillets'] = 1;
                }
                $session->set('nombre', $data['NbBillets']);
                return $this->redirectToRoute('order');
            }
        }
    
        return $this->render('NbGraphicsCoreBundle:Default:index.html.twig',  array(
            'form3' => $form3->createView()));
    }
}
