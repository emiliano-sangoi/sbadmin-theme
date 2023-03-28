<?php

namespace Caja\SBAdminThemeBundle\Twig;

use Caja\SBAdminThemeBundle\Util\Util;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Description of BaseExtension
 *
 * @author esangoi
 */
class BaseExtension extends AbstractExtension {
    
    public function getFilters()
    {
        return array(
            new TwigFilter('cuit', [$this, 'formatCuit']),
            new TwigFilter('ucwords', [$this, 'ucwords']),
            new TwigFilter('quitar_get_params', [$this, 'quitarGetParameters']),
            //new TwigFilter('ucwords', [$this, 'ucwords']),
        );
    }
    
    public function getFunctions()
    {
        return [
            //new \Twig_SimpleFunction('ucwords', 'ucwords')
        ];
    }
    
    /**
     * Filtro para formatear el CUIT.
     * 
     * El valor pasado debe tener 11 caracteres.
     * 
     * @param type $cuit
     * @return string
     */
    public function formatCuit($cuit)
    {
        return Util::formatCuit($cuit);        
    }
    
    public function ucwords($value)
    {
        return ucwords( strtolower($value) );
    }

    /**
     * Metodo que borra los parametros de tipo GET de la url.
     * Por ejemplo, las urls:
     *      - http://.../oficina/1671/show?oficina_id=1671
     * Quedaran:
     *      - http://.../oficina/1671/show
     * 
     * Esto solo se utiliza en los breadcrumb, que en algunas rutas
     * se esta anexando los parametros definidos en ParamConverter como
     * 
     * @param string $url
     * @return type
     */
    public function quitarGetParameters($url)
    {
        
        /*if( filter_var($url, FILTER_VALIDATE_URL) ){
            return $url;
        }*/
                                
        $parts = explode('?', $url);
        return isset($parts[0]) ? $parts[0] : $url;        
    }
    
}
