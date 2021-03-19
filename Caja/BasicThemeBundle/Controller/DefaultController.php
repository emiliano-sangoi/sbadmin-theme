<?php

namespace Caja\BasicThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CajaBasicThemeBundle:Default:index.html.twig');
    }
}
