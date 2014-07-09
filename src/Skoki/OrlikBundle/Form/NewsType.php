<?php

namespace Skoki\OrlikBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', "text",array('required' => false, 'label' => 'Tytuł'))
            ->add('introduction', "textarea", array('required' => false, 'label' => 'Streszczenie'))
            ->add('content', "textarea", array('label' => 'Treść', 'attr' => array(
                'class' => 'tinymce',
                'data-theme' => 'bbcode' // Skip it if you want to use default theme
            )
            ))
            ->add('Dodaj', 'submit');
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Skoki\OrlikBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'skoki_orlikbundle_news';
    }
}
