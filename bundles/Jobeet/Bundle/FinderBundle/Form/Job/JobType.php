<?php

namespace Jobeet\Bundle\FinderBundle\Form\Job;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JobType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('company')
            ->add('logo')
            ->add('url', 'url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply')
            ->add('token')
            ->add('is_public', 'checkbox')
            ->add('is_activated', 'checkbox')
            ->add('email', 'email')
            ->add('expires_at', 'datetime')
            ->add('category', 'entity', [
                'class'         => 'JobeetFinderBundle:Category\Category',
                'property'      => 'name',
                'empty_value'   => 'Choose a category'
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Jobeet\Finder\Application\UseCase\Dto\Job\Job'
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jobeet_bundle_finderbundle_job_job';
    }
}
