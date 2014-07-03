<?php

namespace Cup\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Cup\HomeBundle\Repository\Repository;

class CupTeamType extends AbstractType
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
            ->add('name')
            ->add('logo')
            ->add('cup')
            ->add('grupa','choice', array(
                'choices'   => $this->groupRepo->getListForForm(),
                'required'  => false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cup\HomeBundle\Entity\CupTeam'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cup_homebundle_cup_team';
    }
}
