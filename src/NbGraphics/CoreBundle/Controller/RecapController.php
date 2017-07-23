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
    
    class RecapController extends Controller
    {
        public function recapAction(Request $request)
        {
            $session = $request->getSession();
            $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('NbGraphicsCoreBundle:Basket');
            
            $order = $repository->find($session->get('panier'));
            $amount = ($order->getTotal()*100);
            $session->set('amount', $amount);
            
            return $this->render('NbGraphicsCoreBundle:Order:recap.html.twig', array('order' => $order));
        }
    }
     