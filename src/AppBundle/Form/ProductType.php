<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vendor')
            ->add('link')
            ->add('product')
            ->add('launchDate')
            ->add('launchTime')
            ->add('frontEndPrice')
            ->add('commision')
            ->add('jvPage')
            ->add('affiliateNetwork')
            ->add('niche')
            ->add('status',ChoiceType::class,array(
                'choices'=>array(
                    'good'=>'Good',
                    'bad'=>'Bad',
                    'not_sure'=>'Not sure'
                )
            ))
            ->add('comment')
            ->add('save', SubmitType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'app_bundle_poduct_type';
    }
}
