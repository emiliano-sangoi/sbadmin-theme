<?php

namespace Caja\BasicThemeBundle\Sidebar;

use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Clase auxiliar para mostrar menus laterales en las paginas
 *
 * @author esangoi
 */
class Sidebar {

    /**
     *
     * @var ParameterBag 
     */
    private $sidebarItems;
    
    public function __construct() {
        $this->sidebarItems = new ParameterBag();
    }
    
    public function add($key, Item $item){
        if(!$this->sidebarItems->has($key)){
            $this->sidebarItems->set($key, $item);
            return true;
        }
        return false;
    }
    
    public function removeItem($key){
        if(!$this->sidebarItems->has($key)){
            $this->sidebarItems->remove($key);
            return true;
        }
        return false;
    }

    public function getSidebar() {
        return $this->sidebarItems;
    }

    public function setActive($cod){
        if($this->sidebarItems->has($cod)){
            $this->sidebarItems->get($cod)->setActive(true);
            return true;
        }
        return false;
    }


}
