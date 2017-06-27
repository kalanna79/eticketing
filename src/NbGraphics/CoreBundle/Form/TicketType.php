<?php

namespace NbGraphics\CoreBundle\Form;

use NbGraphics\CoreBundle\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
        $builder->add('firstname',  TextType::class)
                ->add('name',       TextType::class)
                ->add('birthday',   DateType::class)
                ->add('country',    CountryType::class)
                ->add('visitdate',  DateType::class)
                ->add('duration',   ChoiceType::class, array(
                    'choices' => array(
                        'toute la journée' => 'allday',
                        'l\'après-midi' => "midday"
                    )
                ))
                ->add('price',      NumberType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Ticket::class,
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
