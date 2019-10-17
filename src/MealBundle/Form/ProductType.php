<?php

namespace MealBundle\Form;

use MealBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductType
 * @package MealBundle\Form
 */
class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('name', TextType::class,[
                'label' => 'Nazwa produktu',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nazwa produktu'
                ]
            ])->add('calories', NumberType::class, [
                'label' => 'Liczba kalorii [kcal/100g]',
                'required' => true,
                'attr' => [
                    'placeholder' => 'kcal/100g'
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
            'data_class' => Product::class,
        ]);
    }
}
