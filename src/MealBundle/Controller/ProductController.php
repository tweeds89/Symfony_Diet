<?php

namespace MealBundle\Controller;

use MealBundle\Entity\Product;
use MealBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ProductController
 * @package MealBundle\Controller
 */
class ProductController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository('MealBundle:Product')->findAll();
        return $this->render('@Meal/Product/index.html.twig', ['products' => $products]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function addProductAction(Request $request): Response
    {
        $form = $this->createForm(ProductType::class, new Product(), ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Produkt został dodany');
            return $this->redirectToRoute('product_list');
        }

        return $this->render('@Meal/Product/add_product.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @ParamConverter(name="product", class="MealBundle:Product", options={"id" = "product"})
     * @param Request $request
     * @param Product $product
     * @return Response
     */
    public function editProductAction(Request $request, Product $product): Response
    {
        $form = $this->createForm(ProductType::class, $product, ['method' => 'POST']);
        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            $this->addFlash('success', 'Produkt został zmieniony');
            return $this->redirectToRoute('product_list');
        }

        return $this->render('@Meal/Product/add_product.html.twig', [
            'form' => $form->createView(),
            'product' => $product
        ]);
    }

    /**
     * @ParamConverter(name="product", class="MealBundle:Product", options={"id" = "product"})
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function deleteProductAction(Product $product): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        $this->addFlash('danger', 'Produkt został usunięty');
        return $this->redirectToRoute('product_list');
    }
}
