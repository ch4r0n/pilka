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
            ->add('firstname', 'text', array('required'  => true))
            ->add('lastname', 'text', array('required'  => true))
//            ->add('userId')
            ->add('age', 'number', array('required'  => false))
            ->add('height', 'number', array('required'  => false))
            ->add('numer', 'number', array('required'  => false))
            ->add('country', 'text', array('required'  => false))
            ->add('pozycja', 'text', array('required'  => false))
            ->add('other', 'text', array('required'  => false))
            ->add('team')
            ->add('image', 'file', array(
                'required' => false,
                'label' => 'zdjecie',
                'error_bubbling' => false
            ))
            ->add('dodaj', 'submit');
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
