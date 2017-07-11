<?php
    
    /**
     * Created by PhpStorm.
     * User: natacha
     * Date: 09/07/2017
     * Time: 10:36
     */
    
    namespace NBGraphics\CoreBundle\Validator\Constraints;

    use Symfony\Component\Validator\Constraint;
    
    class numberTicketsValid extends Constraint
    {
     public $message = "Il n'y a plus de billets disponibles pour aujourd'hui. Veuillez sélectionner une autre date
     .";
     
     public function validatedBy()
     {
         return 'nb_core_numbertickets';
     }
    }