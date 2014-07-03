<?php

namespace Skoki\OrlikBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatchesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('home')
            ->add('away')
            ->add('matchDate')
            ->add('result')
            ->add('scoreHome')
            ->add('scoreAway')
            ->add('redHome')
            ->add('redAway')
            ->add('yellowHome')
            ->add('yellowAway')
            ->add('rounds')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skoki\OrlikBundle\Entity\Matches'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skoki_orlikbundle_matches';
    }
}
