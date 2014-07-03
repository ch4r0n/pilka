<?php

namespace Skoki\OrlikBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StatTableType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('teamId')
            ->add('teamName')
            ->add('rs')
            ->add('z')
            ->add('r')
            ->add('p')
            ->add('bz')
            ->add('bs')
            ->add('rb')
            ->add('pkt')
            ->add('poz')
            ->add('tournament')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skoki\OrlikBundle\Entity\StatTable'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skoki_orlikbundle_stattable';
    }
}
