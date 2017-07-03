<?php
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 30/06/2017
     * Time: 17:12
     */
    
    namespace NbGraphics\CoreBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    
    
    class PaymentController extends Controller
    {
        
        public function checkoutAction(Request $request)
        {
            $basket = $this->get('nb_graphics_core.payment')->setCheckout($request);
            $session = $request->getSession();
            $session->invalidate();
            return $this->render("NbGraphicsCoreBundle:Order:prepare.html.twig", array('basket' => $basket));
        }
    }