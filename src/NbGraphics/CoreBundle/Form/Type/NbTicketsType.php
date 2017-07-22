<?php

namespace NbGraphics\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NbTicketsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('choiceNb', ChoiceType::class, array(
            'choices' => array(
                'seul' => '1',
                'accompagné de' => '2'),
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
            ->add('suivant', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array());
    }
    

}
 
