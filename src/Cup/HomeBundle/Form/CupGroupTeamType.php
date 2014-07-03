<?php

namespace Cup\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CupGroupTeamType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('place')
            ->add('cupGroup')
            ->add('cupTeam')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cup\HomeBundle\Entity\CupGroupTeam'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cup_homebundle_cup_group_team';
    }
}
