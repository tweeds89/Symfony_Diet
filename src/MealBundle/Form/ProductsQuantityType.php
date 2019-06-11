<?php

namespace MealBundle\Form;

use MealBundle\Entity\Product;
use MealBundle\Entity\ProductsQuantity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductsQuantityType
 * @package MealBundle\Form
 */
class ProductsQuantityType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('product', EntityType::class,[
                'class' => Product::class,
                'label' => 'Nazwa produktu',
            ])
            ->add('amount', NumberType::class, [
                'label' => 'Ilość',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ilość'
                ]
            ])
            ->add('removeProduct', ButtonType::class, [
                'label' => 'X',
                'attr'  => [
                    'class' => 'btn-danger removeProductsQuantity'
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductsQuantity::class
        ]);
    }
}
