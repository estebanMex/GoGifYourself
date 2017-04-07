<?php

namespace GGY\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class CategoryController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/categories")
     */
    public function getCategoriesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('GGYDataBundle:Category')->findAll();
        return $categories;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/category/{id}")
     */
    public function getCategoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('GGYDataBundle:Category')->findById($request->get('id'));

        if (empty($category)) {
            return new JsonResponse(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }
        return $category;
    }

}
