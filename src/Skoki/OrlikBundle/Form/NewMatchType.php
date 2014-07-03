<?php

namespace Skoki\OrlikBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewMatchType extends AbstractType
{

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->teamsRepo = $entityManager->getRepository('SkokiOrlikBundle:Teams');
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('home','choice', array(
                'choices'   => $this->teamsRepo->getListForForm(),
                'required'  => false,
            ))
            ->add('away','choice', array(
                'choices'   => $this->teamsRepo->getListForForm(),
                'required'  => false,
            ))
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
     * Get default options
     *
     * @param OptionsResolverInterface $resolver
     *
     * @return array
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
        return 'skoki_orlik_nowy_mecz';
    }
} 