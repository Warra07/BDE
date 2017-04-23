<?php

namespace Activite\ActiviteBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Activite\ActiviteBundle\Form\activiteType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ancienneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('activite', activiteType::class)
        ->add('date', DateTimeType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Activite\ActiviteBundle\Entity\ancienne'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'activite_activitebundle_ancienne';
    }


}
