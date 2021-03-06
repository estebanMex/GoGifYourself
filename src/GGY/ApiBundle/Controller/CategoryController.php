<?php

namespace GGY\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use GGY\DataBundle\Entity\Category;

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

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/categories")
     */
    public function postCategoriesAction(Request $request)
    {
        $category = new Category;
        $form = $this->createForm('GGY\DataBundle\Form\CategoryType', $category);
        $form->submit($request->request->all());
        if($form->isValid())
        {
            $category->setTitle($request->get('title'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
            return $category;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/category/{id}")
     */
    public function removeCategoryAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('GGYDataBundle:Category')
            ->find($request->get('id'));

        if ($category){
            $em->remove($category);
            $em->flush();
        }
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/category/{id}")
     */
    public function updateCategoryAction(Request $request)
    {
        $category = $this->getDoctrine()->getManager()->getRepository('GGYDataBundle:Category')->find($request->get('id'));

        if (empty($category)) {
            return \FOS\RestBundle\View\View::create(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm('GGY\DataBundle\Form\CategoryType', $category);

        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->merge($category);
            $em->flush();
            return $category;
        } else {
            return $form;
        }
    }

}
