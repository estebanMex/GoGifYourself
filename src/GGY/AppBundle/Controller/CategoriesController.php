<?php

namespace GGY\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/categories")
 */
class CategoriesController extends Controller
{
    /**
     * @Route("/", name="list_categories")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository("GGYDataBundle:Category")->listByAlphabet();
        return $this->render('GGYAppBundle:Categories:list.html.twig', array(
            'categories' => $categories
        ));
    }
}
