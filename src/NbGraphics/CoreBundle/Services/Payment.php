<?php
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 29/06/2017
     * Time: 15:00
     */
    
    namespace NbGraphics\CoreBundle\Services;
    
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\RedirectResponse;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\Swift_Mailer;

    class Payment
    {
        private $booking;
        private $em;
        private $mailer;
        
    
        /**
         * Booking constructor.
         * @param Booking                $booking
        
         */
        public function __construct(\NbGraphics\CoreBundle\Services\Booking $booking, EntityManagerInterface $em,
                                    \Swift_Mailer $mailer, $templating)
        {
            $this->booking = $booking;
            $this->em = $em;
            $this->mailer = $mailer;
            $this->templating = $templating;
        }
    
        /** stripe checkout
         * @param Request $request
         * @return \Stripe\Charge
         */
        public function setCheckout(Request $request)
        {
            $session = $request->getSession();
            $amount = ($session->get('amount'));
            $id = $session->get('panier');
            $email = $session->get('email');
            dump($id);
    
            \Stripe\Stripe::setApiKey("sk_test_tVpqFhaPaWWOPOkhtc3rnxg5");
    
            $token = $_POST['stripeToken'];
    
            try {
                $charge = \Stripe\Charge::create(array(
                                                     'amount'      => $amount,
                                                     'currency'    => "eur",
                                                     "source"      => $token,
                                                     "description" => "Paiement Musée du Louvre",
                                                     "metadata"    => array("order_id" => $id),
                                                     "receipt-email" => $email
                                                 ));
                $session->getFlashBag()->add("notice", "Votre paiment de ". ($amount/100) . " € a bien été accepté, votre commande est confirmée");
                $repository = $this->em->getRepository('NbGraphicsCoreBundle:Basket');
    
                $order = $repository->find($session->get('panier'));
                $update = $order->setStatus("valide");
                $this->em->persist($update);
                $this->em->flush();
                $this->sendTickets($request);
                $session->clear();
                return $charge;
            } catch (\Stripe\Error\Card $e) {
                $session->getFlashBag()->addFlash("notice", "Votre paiement a échoué, veuillez recommencer");
        
                return $this->redirectToRoute('recap');
            }
        }
    
        public function sendTickets(Request $request)
        {
            $session = $request->getSession();
        
            $repository = $this->em->getRepository('NbGraphicsCoreBundle:Basket');
        
            $order = $repository->find($session->get('panier'));
        
            $message = new \Swift_Message('Vos billets');
            $message    -> setFrom('natachanoelwork@gmail.com')
                        -> setTo($order->getEmail())
                        -> setBcc('natacha@boudetnature.com')
                        -> setBody(
                    $this->templating->render('NbGraphicsCoreBundle:Emails:confirmation.html.twig',
                                      array('order' => $order)
                    ),
                    'text/html'
                );
        
            $this->mailer->send($message);
        }
    }