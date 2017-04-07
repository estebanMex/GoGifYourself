<?php

namespace GGY\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;


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
}
