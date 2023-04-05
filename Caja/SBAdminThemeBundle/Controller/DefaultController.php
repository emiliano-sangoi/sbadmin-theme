<?php

namespace Caja\SBAdminThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@CajaSBAdminTheme/default/index.html.twig');
    }
}
