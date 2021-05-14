<?php

namespace Caja\BasicThemeBundle\Sidebar;

/**
 * Description of Item
 *
 * @author esangoi
 */
class Item {
    
    /**
     *
     * @var string
     */
    private $css;
    
    /**
     *
     * @var string
     */
    private $href;
    
    /**
     *
     * @var string
     */
    private $label;
    
    /**
     *
     * @var boolean 
     */
    private $active;    
    
    /**
     * Nombre del icono, por ej help, error, check, etc.
     * 
     * Ver listado en: https://material.io/resources/icons/
     * 
     * @var string
     */
    private $icon;
    
    /**
     *
     * @var string 
     */
    private $iconCss;
    
    /**
     *
     * @var string 
     */
    private $iconTitle;
    
    /**
     *
     * @var string 
     */
    private $title;
    
    /**
     *
     * @var boolean
     */
    private $targetBlank;
    
    public function __construct() {
        $this->css = 'btn-light';
        $this->active = false;
        $this->iconCss = '';
        $this->iconTitle = '';
        $this->targetBlank = false;
    }
    
    public function getCss() {
      //  return '';
        $aux = $this->css;
        
        if($this->active){
      //      $aux = str_replace('btn-outline-secondary', '', $aux);
            $aux .= ' active';
        }
        
        return $aux;
    }
    
    public function addCss($css) {
        return $this->css .= ' ' . $css;
    }

    public function getHref() {
        return $this->href;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setCss($css) {
        $this->css = $css;
        return $this;
    }

    public function setHref($href) {
        $this->href = $href;
        return $this;
    }

    public function setLabel($label) {
        $this->label = $label;
        return $this;
    }

    public function getActive() {
        return $this->active;
    }

    public function setActive($active = true) {
        $this->active = $active;
        return $this;
    }
    
    public function showIcon() {
        return !empty($this->icon);
    }

    public function getIcon() {
        return $this->icon;
    }

    public function setIcon($icon) {
        $this->icon = $icon;
        return $this;
    }

    public function getIconCss() {
        return $this->iconCss;
    }

    public function setIconCss($iconCss) {
        $this->iconCss = $iconCss;
        return $this;
    }
    
    public function getIconTitle() {
        return $this->iconTitle;
    }

    public function setIconTitle($iconTitle) {
        $this->iconTitle = $iconTitle;
        return $this;
    }

    function getTitle() {
        return $this->title;
    }

    function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    function getTargetBlank() {
        return $this->targetBlank;
    }

    function setTargetBlank($targetBlank) {
        $this->targetBlank = $targetBlank;
        return $this;
    }



}
