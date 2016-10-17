<?php

namespace Beacode\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BeacodeCoreBundle:Default:index.html.twig');
    }
}
