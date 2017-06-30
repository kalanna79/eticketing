<?php

namespace NbGraphics\CoreBundle\Controller;

use NbGraphics\CoreBundle\Entity\Basket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;



class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $nbBillets = array('NbBillets' => 'Nombre de billets');
        $session->set('nombre',$nbBillets);
        $form3 = $this->get('form.factory')->createBuilder(FormType::class)
            ->add('choiceNb', ChoiceType::class, array(
                'choices' => array(
                    'seul' => '1',
                    'accompagné de ' => '2'),
                'expanded' => true,
            ))
            ->add('NbBillets', ChoiceType::class, array(
                'choices'=>array(
                    '1 personne' => '2',
                    '2 personnes' => '3',
                    '3 personnes' => '4',
                    '4 personnes' => '5',
                )
            ))
            ->add('suivant', SubmitType::class)
            ->getForm();
    
    
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
            
                dump($session->get('nombre'));
                return $this->redirectToRoute('order');
            }
        }
    
        return $this->render('NbGraphicsCoreBundle:Default:index.html.twig',  array(
            'form3' => $form3->createView()));
    }
}
