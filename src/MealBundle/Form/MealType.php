<?php

namespace MealBundle\Form;

use MealBundle\Entity\Meal;
use MealBundle\Entity\ProductsQuantity;
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

        $builder
            ->add('name', TextType::class,[
                'label' => 'Nazwa Dania',
                'required' => true
            ])->add('productsQuantity', CollectionType::class, [
                'label' => 'Produkty',
                'entry_type' => ProductsQuantityType::class,
                'allow_add' => true,
                'data' => ['productsQuantity' => new ProductsQuantity()],
                'prototype_name' => '__product__',
                'entry_options' => [
                    'allow_extra_fields' => true,
                    'label' => false
                ],
                'prototype' => true
            ])->add('addProduct', ButtonType::class, [
                'label' => 'Dodaj kolejny produkt',
                'attr'  => [
                    'class' => 'btn-default addProductsQuantity'
                ]
            ])->add('submit', SubmitType::class, [
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
