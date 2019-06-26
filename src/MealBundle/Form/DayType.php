<?php

namespace MealBundle\Form;

use MealBundle\Entity\Day;
use MealBundle\Entity\DayTimeMeal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DayType
 * @package MealBundle\Form
 */
class DayType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        parent::buildForm($builder, $options);

        $builder->add('day', DateType::class, [
            'label' => 'Dzień',
            'required' => true
        ]);

        if (is_null($options['data']->getId())) {
            $builder->add('dayTimeMeals', CollectionType::class, [
                'label' => 'Dania',
                'entry_type' => DayTimeMealType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'data' => ['dayTimeMeal' => new DayTimeMeal()],
                'prototype_name' => '__meal__',
                'entry_options' => [
                    'allow_extra_fields' => true,
                    'label' => false
                ],
                'prototype' => true,
                'by_reference' => false
            ]);
        } else {
            $builder->add('dayTimeMeals', CollectionType::class, [
                'label' => 'Dania',
                'entry_type' => DayTimeMealType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype_name' => '__meal__',
                'entry_options' => [
                    'allow_extra_fields' => true,
                    'label' => false
                ],
                'prototype' => true,
                'by_reference' => false
            ]);
        }
        $builder->add('addMeal', ButtonType::class, [
            'label' => 'Dodaj kolejne danie',
            'attr' => [
                'class' => 'btn-default addDayTimeMeal'
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
            'data_class' => Day::class
        ]);
    }
}
