<?php

namespace MealBundle\Controller;

use MealBundle\Entity\Day;
use MealBundle\Form\DayType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class DayController
 * @package MealBundle\Controller
 */
class DayController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction(): Response
    {
        $days = $this->getDoctrine()->getRepository('MealBundle:Day')->findAllSortedByDate();
        $dayCalories = [];
        foreach ($days as $day) {
            $calories = 0;
            foreach ($day->getDayTimeMeals() as $dayTimeMeal) {
                foreach ($dayTimeMeal->getMeals() as $meal) {
                    $calories += $this->get('calories_counter_manager')->mealCaloriesCount($meal);
                }
            }
            $dayCalories[$day->getId()] = $calories;
        }

        return $this->render('@Meal/Day/index.html.twig', [
            'days' => $days,
            'dayCalories' => $dayCalories,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addDayAction(Request $request): Response
    {
        $form = $this->createForm(DayType::class, new Day(), ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Dzień został zaplanowany');
            return $this->redirectToRoute('day_list');
        }

        return $this->render('@Meal/Day/add_day.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @ParamConverter(name="day", class="MealBundle:Day", options={"id" = "day"})
     *
     * @param Day $day
     * @param Request $request
     * @return Response
     */
    public function editDayAction(Day $day, Request $request): Response
    {
        $form = $this->createForm(DayType::class, $day, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Dzień został zmieniony');
            return $this->redirectToRoute('day_list');
        }

        return $this->render('@Meal/Day/add_day.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @ParamConverter(name="meal", class="MealBundle:Day", options={"id" = "day"})
     *
     * @param Day $day
     * @return JsonResponse
     */
    public function deleteDayAction(Day $day): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($day);
        $em->flush();

        $response = new JsonResponse();
        $response->setData(['ok']);
        return $response;
    }
}
