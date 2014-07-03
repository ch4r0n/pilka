<?php

namespace Skoki\OrlikBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlayersType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('userId')
            ->add('age')
            ->add('height')
            ->add('numer')
            ->add('country')
            ->add('pozycja')
            ->add('other')
            ->add('team')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skoki\OrlikBundle\Entity\Players'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skoki_orlikbundle_players';
    }
}
