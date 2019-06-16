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
        $productsQuantity = $meal->getProductsQuantity();
        foreach ($productsQuantity as $productQuantity) {
            $productCalories[$productQuantity->getProduct()->getName()] = [
                'amount' => $productQuantity->getAmount(),
                'calories' => $productQuantity->getProduct()->getCalories() * $productQuantity->getAmount() / 100
            ];
        }
        return $productCalories;
    }

    public function mealCaloriesCount(Meal $meal)
    {
        $mealCalories = 0;
        $productsQuantity = $meal->getProductsQuantity();
        foreach ($productsQuantity as $productQuantity) {
            $mealCalories += $productQuantity->getProduct()->getCalories() * $productQuantity->getAmount() / 100;
        }
        return $mealCalories;
    }
}
