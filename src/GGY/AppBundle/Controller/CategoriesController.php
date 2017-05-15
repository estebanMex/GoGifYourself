<?php

namespace GGY\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository("GGYDataBundle:Category")->listByAlphabet();
        return $this->render('GGYAppBundle:Categories:list.html.twig', array(
            'categories' => $categories
        ));
    }

}
