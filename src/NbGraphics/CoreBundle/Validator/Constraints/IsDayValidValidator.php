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
    use Doctrine\ORM\EntityManagerInterface;
    

    class IsDayValidValidator extends ConstraintValidator
    {
        private $holidays;
        
        public function __construct(EntityManagerInterface $em, $holidays)
        {
            $this->em           = $em;
            $this->holidays     = $holidays;
        }
    
        public function validate($visitdate, Constraint $constraint)
        {
            $today = new \DateTime();
            $year = $today->format('Y');
            $holidays = $this->holidays;
    
            foreach ($holidays as $holiday) {
                $holiday .= $year;
                $holiday = date_create($holiday);
    
                if ($visitdate == $holiday) {
                    $this->context->buildViolation($constraint->message)->addViolation();
                }
            }
        }
    }
