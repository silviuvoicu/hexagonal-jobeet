<?php

namespace Jobeet\Bundle\FinderBundle\Form\Type;

use Jobeet\Bundle\FinderBundle\Form\Transformer\CategoryToNameTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JobType extends AbstractType
{
    /**
     * @var CategoryToNameTransformer
     */
    private $categoryToNameTransformer;

    /**
     * Class constructor
     *
     * @param CategoryToNameTransformer $categoryToNameTransformer
     */
    public function __construct($categoryToNameTransformer)
    {
        $this->categoryToNameTransformer = $categoryToNameTransformer;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categoryFieldBuilder = $builder->create('category', 'entity', [
            'class'         => 'JobeetFinderBundle:Category\Category',
            'property'      => 'name',
            'empty_value'   => 'Choose a category'
        ]);

        $categoryFieldBuilder->addModelTransformer($this->categoryToNameTransformer);

        $builder
            ->add(
                'type',
                'choice',
                [
                    'choices' => [
                        'full-time' => 'Full time',
                        'part-time' => 'Part time',
                        'freelance' => 'Freelance'
                    ]
                ]
            )
            ->add('company')
            ->add('logo', 'file')
            ->add('url', 'url')
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('how_to_apply', 'text', ['label' => 'How to apply?'])
            ->add('is_public', 'checkbox', ['label' => 'Public?'])
            ->add('email', 'email')
            ->add($categoryFieldBuilder)
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
        return 'job';
    }
}
