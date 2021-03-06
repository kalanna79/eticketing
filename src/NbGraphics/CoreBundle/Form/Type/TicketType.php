<?php

namespace NbGraphics\CoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname',  TextType::class, array('label' => 'Prénom'))
                ->add('name',       TextType::class, array('label' => 'Nom'))
                ->add('birthday',   DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'label'  => 'Date de naissance',
                    'invalid_message' => "date_birth"
                ))
                ->add('country',    CountryType::class, array(
                    'preferred_choices' => array('FR'),
                    'label' => 'Pays'
                ))
                ->add('visitdate',  DateType::class, array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'label'  => 'Date de la visite',
                    'attr'   =>  array(
                        'class'   => 'js-datepicker',
                        'id'      => 'visit'),
                    'html5' => false,
                ))
                ->add('duration',   ChoiceType::class, array(
                    'choices' => array(
                        'toute la journée' => '1',
                        'l\'après-midi' => "2"
                    ),
                    'label' => 'Durée'
                ))
                ->add('reduction', CheckboxType::class, array(
                    'label' => 'Vous bénéficiez d\'un tarif réduit',
                    'required' => false,
                    'empty_data' => null
                ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NbGraphics\CoreBundle\Entity\Ticket',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'nbgraphics_corebundle_ticket';
    }


}
