<?php

namespace MealBundle\Form;

use MealBundle\Entity\Day;
use MealBundle\Entity\Meal;
use MealBundle\Enums\DayTimeEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
     * @throws \ReflectionException
     */
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        parent::buildForm($builder, $options);

        $dayTimes = [];
        $class = new \ReflectionClass(DayTimeEnum::class);
        foreach ($class->getConstants() as $option) {
            $dayTimes['diet.meal.day_times.' . $option] = $option;
        }

        $builder
            ->add('day', DateType::class,[
                'label' => 'Dzień',
                'required' => true
            ])->add('dayTime', ChoiceType::class,[
                'label' => 'Pora dnia',
                'required' => true,
                'choices' => $dayTimes
            ])->add('dayMeals', EntityType::class, [
                'label' => 'Dania',
                'class' => Meal::class,
                'multiple' => true
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
            'data_class' => Day::class
        ]);
    }
}
