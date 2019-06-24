<?php

namespace MealBundle\Form;

use MealBundle\Entity\Product;
use MealBundle\Entity\WeightProduct;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class WeightProductType
 * @package MealBundle\Form
 */
class WeightProductType extends AbstractType
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
            ])
            ->add('weight', NumberType::class, [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Ilość [g]'
                ]
            ])
            ->add('removeWeightProduct', ButtonType::class, [
                'label' => 'X',
                'attr'  => [
                    'class' => 'btn-danger removeWeightProduct'
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WeightProduct::class
        ]);
    }
}
