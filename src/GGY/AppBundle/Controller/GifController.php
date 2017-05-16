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

}
