<?php

namespace Ens\JobeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ens\JobeetBundle\Entity\Job;

class JobType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', 'choice', array('choices' => Job::getTypes(), 'expanded' => true))
            ->add('company')
            ->add('logo', null, array('label' => 'Company logo'))
            ->add('url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply', null, array('label' => 'How to apply?'))
            ->add('is_public', null, array('label' => 'Public?'))
            ->add('isActivated')
            ->add('email')
            ->add('expiresAt')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('category')
            ->add('file', 'file', array('label' => 'Company logo', 'required' => false,'data_class' => null));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ens\JobeetBundle\Entity\Job'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ens_jobeetbundle_job';
    }


}
