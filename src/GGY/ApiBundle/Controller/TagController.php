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

    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/tag/{id}")
     */
    public function removeTagAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tag = $em->getRepository('GGYDataBundle:Tag')
            ->find($request->get('id'));
        if ($tag){
            $em->remove($tag);
            $em->flush();
        }

    }

    /**
     * @Rest\View()
     * @Rest\Patch("/tag/{id}")
     */
    public function updateTagAction(Request $request)
    {
        $tag = $this->getDoctrine()->getManager()->getRepository('GGYDataBundle:Tag')->find($request->get('id'));

        if (empty($tag)) {
            return \FOS\RestBundle\View\View::create(['message' => 'Tag not found'], Response::HTTP_NOT_FOUND);
        }
        $form = $this->createForm('GGY\DataBundle\Form\TagType', $tag);

        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->merge($tag);
            $em->flush();
            return $tag;
        } else {
            return $form;
        }
    }
}