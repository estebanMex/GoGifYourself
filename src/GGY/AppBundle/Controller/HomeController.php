<?php

namespace GGY\AppBundle\Controller;

use GGY\AppBundle\GGYAppBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $gifs = $em->getRepository("GGYDataBundle:Gif")->findAll();
        return $this->render(
            'GGYAppBundle:Home:index.html.twig',
            array('gifs' => $gifs)
        );
    }

}
