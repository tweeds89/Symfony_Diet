<?php

namespace MealBundle\Form;

use MealBundle\Entity\DayTimeMeal;
use MealBundle\Entity\Meal;
use MealBundle\Enums\DayTimeEnum;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DayTimeMealType
 * @package MealBundle\Form
 */
class DayTimeMealType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @throws \ReflectionException
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $dayTimes = [];
        $class = new \ReflectionClass(DayTimeEnum::class);
        foreach ($class->getConstants() as $option) {
            $dayTimes['diet.meal.day_times.' . $option] = $option;
        }

        $builder
            ->add('dayTime', ChoiceType::class, [
                'label' => 'Pora dnia',
                'required' => true,
                'choices' => $dayTimes
            ])
            ->add('meal', EntityType::class,[
                'class' => Meal::class,
                'label' => 'Danie'
            ])
            ->add('removeDayTimeMeal', ButtonType::class, [
                'label' => 'X',
                'attr'  => [
                    'class' => 'btn-danger removeDayTimeMeal'
                ]
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DayTimeMeal::class
        ]);
    }
}
