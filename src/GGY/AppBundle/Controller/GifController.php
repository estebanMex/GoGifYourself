<?php

namespace GGY\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class GifController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $gifs = $em->getRepository("GGYDataBundle:Gif")->findAll();
        return $this->render('GGYAppBundle:Gif:index.html.twig', array(
            'gifs' => $gifs
        ));
    }

    /**
     * @Route("/category/{slug}", name="gif_by_category_slug")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getByCategorySlug($slug){
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository("GGYDataBundle:Category")->findOneBySlug($slug);
        $gifs = $category->getGifs();
        return $this->render('GGYAppBundle:Gif:index.html.twig', array(
            'title' => $category->getTitle(),
            'gifs' => $gifs
        ));
    }

}
