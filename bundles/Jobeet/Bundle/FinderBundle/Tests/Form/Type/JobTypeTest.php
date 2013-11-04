<?php

namespace Jobeet\Bundle\FinderBundle\Tests\Form\Type;

use DateTime;
use Mockery;
use Jobeet\Bundle\FinderBundle\Form\Transformer\CategoryToNameTransformer;
use Jobeet\Bundle\FinderBundle\Form\Type\JobType;
use Jobeet\Finder\Application\UseCase\Dto\Category\Category;
use Jobeet\Finder\Application\UseCase\Dto\Job\Job;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobTypeTest extends TypeTestCase
{
    protected function getExtensions()
    {
        $entityType = Mockery::mock('Symfony\Bridge\Doctrine\Form\Type\EntityType')->shouldIgnoreMissing();

        $entityType->shouldReceive('getName')->andReturn('entity');
        $entityType->shouldReceive('setDefaultOptions')->with(Mockery::on(function(OptionsResolver $optionsResolver) {
            $optionsResolver->setRequired(['class', 'property', 'empty_value']);

            return true;
        }));

        return [
            new PreloadedExtension([
                $entityType->getName() => $entityType
            ], [])
        ];
    }

    /**
     * @test
     */
    public function it_should_be_able_to_submit_data_and_retrieve_correct_values()
    {
        $actualCategoryDto = new Category();
        $actualCategoryDto->setId(1);
        $actualCategoryDto->setName('test');

        $formData = [
            'category'      => $actualCategoryDto,
            'type'          => 'full-time',
            'company'       => 'test',
            'logo'          => 'test',
            'url'           => 'http://test.com',
            'position'      => 'test',
            'location'      => 'test',
            'description'   => 'test',
            'how_to_apply'  => 'test',
            'is_public'     => true,
            'email'         => 'test@test.com',
        ];

        $type = new JobType(new CategoryToNameTransformer());
        $form = $this->factory->create($type);

        $form->submit($formData);

        $expectedCategoryDto = new Category();
        $expectedCategoryDto->setId(1);

        $expected = new Job();
        $expected
            ->setCategory($expectedCategoryDto)
            ->setType('full-time')
            ->setCompany('test')
            ->setLogo('test')
            ->setUrl('http://test.com')
            ->setPosition('test')
            ->setLocation('test')
            ->setDescription('test')
            ->setHowToApply('test')
            ->setIsPublic(true)
            ->setEmail('test@test.com')
        ;

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($expected, $form->getData());
    }
}