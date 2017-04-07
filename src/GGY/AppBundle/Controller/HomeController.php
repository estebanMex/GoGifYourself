<?php

namespace GGY\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $gifs = $em->getRepository('GGYDataBundle:Gif')->findAll();
        return $this->render('GGYAppBundle:Home:index.html.twig', array('gifs' => $gifs));
    }

}
