<?php

namespace MealBundle\Form;

use MealBundle\Entity\Meal;
use MealBundle\Entity\WeightProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MealType
 * @package MealBundle\Form
 */
class MealType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        parent::buildForm($builder, $options);

        $builder->add('name', TextType::class, [
            'label' => 'Nazwa dania',
            'required' => true,
            'attr' => [
                'placeholder' => 'Nazwa dania'
            ]
        ]);

        if (is_null($options['data']->getId())) {
            $builder->add('weightProducts', CollectionType::class, [
                'label' => 'Produkty',
                'entry_type' => WeightProductType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'data' => ['weightProduct' => new WeightProduct()],
                'prototype_name' => '__product__',
                'entry_options' => [
                    'label' => false
                ],
                'prototype' => true,
                'by_reference' => false,
            ]);
        } else {
            $builder->add('weightProducts', CollectionType::class, [
                'label' => 'Produkty',
                'entry_type' => WeightProductType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype_name' => '__product__',
                'entry_options' => [
                    'allow_extra_fields' => true,
                    'label' => false
                ],
                'prototype' => true,
                'by_reference' => false,
            ]);
        }
        $builder->add('addWeightProduct', ButtonType::class, [
            'label' => 'Dodaj kolejny produkt',
            'attr' => [
                'class' => 'btn-default addWeightProduct'
            ]
        ])
            ->add('submit', SubmitType::class, [
                'label' => 'Dodaj'
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Meal::class
        ]);
    }
}
