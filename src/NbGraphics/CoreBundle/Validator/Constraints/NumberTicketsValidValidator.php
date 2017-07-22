<?php
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 09/07/2017
     * Time: 15:15
     */
    
    namespace NbGraphics\CoreBundle\Validator\Constraints;

    use Symfony\Component\Validator\Constraint;
    use Symfony\Component\Validator\ConstraintValidator;
    use NbGraphics\CoreBundle\Entity\Ticket;
    use Doctrine\ORM\EntityManagerInterface;

    
    class NumberTicketsValidValidator extends ConstraintValidator
    {
        private $em;
        public function __construct(EntityManagerInterface $em)
        {
            $this->em           = $em;
    
        }
    
        public function validate($visitdate, Constraint $constraint)
        {
            $today = new \DateTime();
            $count = count($this->em->getRepository(Ticket::class)->findBy(array('visitdate'=>$today)));
            
            if ($count >=1000)
            {
                $this->context->buildViolation($constraint->message)->addViolation();
            }
        }
    }
     