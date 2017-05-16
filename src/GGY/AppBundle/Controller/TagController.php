<?php

namespace GGY\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TagController extends Controller
{
    /**
     * @Route("/")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository("GGYDataBundle:Tag")->listByAlphabet();
        return $this->render('GGYAppBundle:Tag:list.html.twig', array(
            'tags' => $tags
        ));
    }

}
