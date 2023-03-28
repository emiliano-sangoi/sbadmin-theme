<?php

namespace Caja\SBAdminThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CajaSBAdminThemeBundle:Default:index.html.twig');
    }
}
