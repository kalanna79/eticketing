<?php
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 29/06/2017
     * Time: 13:36
     */
    
    namespace NbGraphics\CoreBundle\Controller;
    
    
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;

    use NbGraphics\CoreBundle\Entity\Basket;
    use Symfony\Component\Form\Extension\Core\Type\FormType;
    use Symfony\Component\Form\Form;


    class RecapController extends Controller
    {
        public function RecapAction(Request $request)
        {
            $pricing = $this->container->get('nb_graphics_core.pricing');
            
            $basket = $request->getSession()->get;
            dump($basket); exit;
    
            return $this->render('NbGraphicsCoreBundle:Order:recap.html.twig');
            
        }
    }