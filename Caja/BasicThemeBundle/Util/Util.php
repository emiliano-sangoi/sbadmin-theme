<?php

namespace Caja\BasicThemeBundle\Util;

/**
 * Description of Util
 *
 * @author esangoi
 */
class Util {
    
    const CUIT_SEP = '-';
    
    /**
     * Funcion que permite formatear el cuit.
     * 
     * @param type $cuit
     * @return boolean|string
     */
    public static function formatCuit($cuit){        
        if(!is_string($cuit) || strlen($cuit) != 11){
            return null;
        }
        
        $f_cuit = substr($cuit, 0, 2) . self::CUIT_SEP 
                . substr($cuit, 2, 8) . self::CUIT_SEP 
                . substr($cuit, -1);
        
        return $f_cuit;
    }
    
    public static function sanitizeCUIT($cuit){
        $s_cuit = filter_var($cuit, FILTER_SANITIZE_NUMBER_INT);
        return str_replace(array('+', '-','_',' '), '', $s_cuit);
    }

    /**
     * Permite aplicar un formato al titulo principal de cada pagina.
     * 
     * Se puso en esa clase para facilitar el cambio.
     * 
     * @param string $title
     * @return string
     */
    public static function titleFormatter($title = 'Titulo'){
        return ucfirst( strtolower($title) );
    }
}
