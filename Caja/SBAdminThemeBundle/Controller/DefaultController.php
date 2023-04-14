<?php

namespace Caja\SBAdminThemeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        return $this->render('@CajaSBAdminTheme/default/index.html.twig', [
            'titulo_pagina' => 'Dashboard'
        ]);
    }

    public function layoutStaticAction()
    {
        return $this->render('@CajaSBAdminTheme/default/layout-static.html.twig', [
            'titulo_pagina' => 'Static Navigation'
        ]);
    }

    public function layoutSidenavLightAction()
    {
        return $this->render('@CajaSBAdminTheme/default/layout-sidenav-light.html.twig');
    }

    public function loginAction()
    {
        return $this->render('@CajaSBAdminTheme/default/login.html.twig');
    }

    public function registerAction()
    {
        return $this->render('@CajaSBAdminTheme/default/register.html.twig');
    }

    public function passwordAction()
    {
        return $this->render('@CajaSBAdminTheme/default/password.html.twig');
    }

    public function pages401Action()
    {
        return $this->render('@CajaSBAdminTheme/default/401.html.twig');
    }

    public function pages404Action()
    {
        return $this->render('@CajaSBAdminTheme/default/404.html.twig');
    }

    public function pages500Action()
    {
        return $this->render('@CajaSBAdminTheme/default/500.html.twig');
    }

    public function chartsAction()
    {
        return $this->render('@CajaSBAdminTheme/default/charts.html.twig', [
            'titulo_pagina' => 'Charts'
        ]);
    }

    public function tablesAction()
    {
        return $this->render('@CajaSBAdminTheme/default/tables.html.twig', [
            'titulo_pagina' => 'Tables'
        ]);
    }

}
