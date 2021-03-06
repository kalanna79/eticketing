<?php
    
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 09/07/2017
     * Time: 10:36
     */
    
    namespace NbGraphics\CoreBundle\Validator\Constraints;

    use Symfony\Component\Validator\Constraint;


    /**
     * @Annotation
     */
    
    class IsDayValid extends Constraint
    {
     public $message = 'holiday';
     
     public function validatedBy()
     {
         return 'nb_core_holidays';
     }
    }
