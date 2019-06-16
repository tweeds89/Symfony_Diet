<?php

namespace MealBundle\Controller;

use MealBundle\Entity\Meal;
use MealBundle\Form\MealType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MealController
 * @package MealBundle\Controller
 */
class MealController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $meals = $this->getDoctrine()->getRepository('MealBundle:Meal')->findAll();
        return $this->render('@Meal/Meal/index.html.twig', ['meals' => $meals]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addMealAction(Request $request): Response
    {
        $form = $this->createForm(MealType::class, new Meal(), ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Danie zostało dodane');
            return $this->redirectToRoute('meal_list');
        }

        return $this->render('@Meal/Meal/add_meal.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @ParamConverter(name="meal", class="MealBundle:Meal", options={"id" = "meal"})
     *
     * @param Meal $meal
     * @return Response
     */
    public function deleteMealAction(Meal $meal): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($meal);
        $em->flush();

        $this->addFlash('danger', 'Danie zostało usunięte');
        return $this->redirectToRoute('meal_list');
    }

    /**
     * @ParamConverter(name="meal", class="MealBundle:Meal", options={"id" = "meal"})
     * @param Meal $meal
     * @return Response
     */
    public function detailsMealAction(Meal $meal): Response
    {
        $productsCalories = $this->get('calories_counter_manager')->productCaloriesCount($meal);
        $mealCalories = $this->get('calories_counter_manager')->mealCaloriesCount($meal);
        return $this->render('@Meal/Meal/details.html.twig', [
            'meal' => $meal,
            'productsCalories' => $productsCalories,
            'mealCalories' => $mealCalories
        ]);
    }
}
