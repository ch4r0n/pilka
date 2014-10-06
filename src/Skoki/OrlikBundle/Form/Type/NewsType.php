<?php

namespace Skoki\OrlikBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('id', 'hidden', array('required' => false));
        $builder->add('title', 'text', array('required' => false, 'label' => 'Tytuł:'));
        $builder->add('introduction','textarea', array('required' => false, 'label' => 'Wstęp:'));
        $builder->add('content', 'textarea', array('required' => false, 'label' => 'Treść:'));
        $builder->add('Dodaj', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skoki\OrlikBundle\Entity\News',
        ));
    }

    public function getName()
    {
        return 'newNews';
    }
}