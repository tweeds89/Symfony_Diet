<?php

namespace HomepageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomepageController
 * @package HomepageBundle\Controller
 */
class HomepageController extends Controller
{
    /**
     * @return Response
     */
    public function indexAction()
    {
        return $this->render('@Homepage/homepage/index.html.twig', []);
    }
}
