<?php

namespace MealBundle\Services;

use MealBundle\Entity\Meal;

/**
 * Class CaloriesCounterManager
 * @package MealBundle\Services
 */
class CaloriesCounterManager
{
    /**
     * @param Meal $meal
     * @return array
     */
    public function productCaloriesCount(Meal $meal): array
    {
        $productCalories = [];
        $weightProducts = $meal->getWeightProducts();
        foreach ($weightProducts as $weightProduct) {
            $productCalories[$weightProduct->getProduct()->getName()] = [
                'weight' => $weightProduct->getWeight(),
                'calories' => $weightProduct->getProduct()->getCalories() * $weightProduct->getWeight() / 100
            ];
        }
        return $productCalories;
    }

    /**
     * @param Meal $meal
     * @return float|int
     */
    public function mealCaloriesCount(Meal $meal)
    {
        $mealCalories = 0;
        $weightProducts = $meal->getWeightProducts();
        foreach ($weightProducts as $weightProduct) {
            $mealCalories += $weightProduct->getProduct()->getCalories() * $weightProduct->getWeight() / 100;
        }
        return $mealCalories;
    }
}
