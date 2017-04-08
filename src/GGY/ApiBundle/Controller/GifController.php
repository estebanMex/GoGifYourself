<?php

namespace GGY\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use GGY\DataBundle\Entity\Gif;

class GifController extends Controller
{
    /**
     * @Rest\View()
     * @Rest\Get("/gifs")
     */
    public function getGifsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gifs = $em->getRepository('GGYDataBundle:Gif')->findAll();
        return $gifs;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/gif/{id}")
     */
    public function getGifAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gif = $em->getRepository('GGYDataBundle:Gif')->findById($request->get('id'));

        if (empty($gif)) {
            return new JsonResponse(['message' => 'Gif not found'], Response::HTTP_NOT_FOUND);
        }
        return $gif;
    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/gifs")
     */
    public function postGifsAction(Request $request)
    {
        $gif = new Gif;
        $form = $this->createForm('GGY\DataBundle\Form\GifType', $gif);
        $form->submit($request->request->all());
        if($form->isValid())
        {
            $gif->setTitle($request->get('title'));
            $gif->setLink($request->get('link'));
            //is_null($request->get('alt')) ? $gif->setAlt($request->get('title')) : $gif->setAlt($request->get('alt'));
            $alt = empty($request->get('alt')) ? $request->get('title') : $request->get('alt');
            $gif->setAlt($alt);
            $gif->setAuthor($request->get('author'));
            $gif->setCreatedAt(new \DateTime);
            $gif->setUpdatedAt(new \DateTime);
            $em = $this->getDoctrine()->getManager();
            $em->persist($gif);
            $em->flush();
            return $gif;
        } else {
            return $form;
        }
    }
}
