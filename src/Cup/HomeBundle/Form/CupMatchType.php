<?php

namespace Cup\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Cup\HomeBundle\Repository\Repository;

class CupMatchType extends AbstractType
{
    public $teamRepo;
    public $groupRepo;
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
        $this->teamsRepo = $entityManager->getRepository(Repository::CUP_TEAM);
        $this->groupRepo = $entityManager->getRepository(Repository::CUP_GROUP);
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cupGroup','choice', array(
                'choices'   => $this->groupRepo->getListForForm(),
                'required'  => false,
            ))
            ->add('matchDate')
            ->add('teamHome','choice', array(
                'choices'   => $this->teamsRepo->getListForForm(),
                'required'  => false,
            ))
            ->add('teamAway','choice', array(
                'choices'   => $this->teamsRepo->getListForForm(),
                'required'  => false,
            ))
            ->add('matchDate', 'datetime', array(
                'input'  => 'datetime',
                'widget' => 'choice'
            ))
            ->add('homeScore')
            ->add('awayScore')
            ->add('result')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cup\HomeBundle\Entity\CupMatch'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cup_homebundle_cup_match';
    }
}
