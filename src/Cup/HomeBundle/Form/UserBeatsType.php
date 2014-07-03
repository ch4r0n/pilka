<?php

namespace Cup\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Cup\HomeBundle\Repository\Repository;

class UserBeatsType extends AbstractType
{
    protected $user;
    protected $teamRepo;

    public function __construct($entityManager, $user)
    {
        $this->user = $user;
        $this->teamRepo = $entityManager->getRepository(Repository::CUP_TEAM);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('win')
            ->add('cupUser', 'hidden', array(
                'data' => $this->user->getId()))
            ->add('cupBeat')
            ->add('cupMatch')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => null
//            'data_class' => 'Cup\HomeBundle\Entity\UserBeats'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cup_homebundle_userbeats';
    }
}
