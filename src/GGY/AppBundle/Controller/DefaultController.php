<?php

namespace GGY\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GGYAppBundle:Default:index.html.twig');
    }
}
