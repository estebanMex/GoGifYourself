<?php

namespace GGY\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use GGY\DataBundle\Entity\Tag;

class TagController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/tags")
     */
    public function getTagsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('GGYDataBundle:Tag')->findAll();
        return $tags;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/tag/{id}")
     */
    public function getTagAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('GGYDataBundle:Tag')->findById($request->get('id'));

        if (empty($tag)) {
            return new JsonResponse(['message' => 'Tag not found'], Response::HTTP_NOT_FOUND);
        }
        return $tag;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/tags")
     */
    public function postTagsAction(Request $request)
    {
        $tag = new Tag;
        $form = $this->createForm('GGY\DataBundle\Form\TagType', $tag);
        $form->submit($request->request->all());
        if($form->isValid())
        {
            $tag->setTitle($request->get('title'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();
            return $tag;
        } else {
            return $form;
        }
    }
}