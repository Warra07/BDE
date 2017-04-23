<?php

namespace Activite\ActiviteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Activite\ActiviteBundle\Form\dateType;
use Activite\ActiviteBundle\Form\activiteType;


class en_voteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('recurrent')
        ->add('nbmin')
        ->add('activite', activiteType::class)
        ->add('date', CollectionType::class, array(
            'entry_type' => dateType::class));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Activite\ActiviteBundle\Entity\en_vote'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'activite_activitebundle_en_vote';
    }


}
