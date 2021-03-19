<?php

namespace Caja\BasicThemeBundle\Traits;

/**
 *
 * @author esangoi
 */
trait MensajesFlashTrait {
    
    //    Iconos de bootstrap utilizado para las notificaciones

    /**
     * 
     * @var string 
     */
    private static $SUCCESS_ICON = 'bi-check-circle';

    /**
     * @var string 
     */
    private static $DANGER_ICON = 'bi-x-circle';

    /**
     * @var string 
     */
    private static $WARNING_ICON = 'bi-exclamation-circle';

    /**
     * @var string 
     */
    private static $INFO_ICON = 'bi-info-circle';

    /**
     * Mensaje exitoso
     * 
     * @param string $content
     * @param bool $mostrar_icono
     */
    public function msgSuccess($content = '', $mostrar_icono = true) {
        $msg = '';
        if ($mostrar_icono) {
            $msg .= "<i class='lead " . self::$SUCCESS_ICON . "'></i> ";
        }
        $msg .= $content;
        $this->addFlash('success', $msg);
    }

    /**
     * Mensaje danger
     * 
     * @param string $content
     * @param bool $mostrar_icono
     */
    public function msgDanger($content = '', $mostrar_icono = true) {        
        $msg = '';
        if ($mostrar_icono) {
            $msg .= "<i class='lead " . self::$DANGER_ICON . "'></i> ";
        }
        $msg .= $content;
        $this->addFlash('danger', $msg);
    }

    /**
     * Mensaje de advertencia
     * 
     * @param string $content
     * @param bool $mostrar_icono
     */
    public function msgWarning($content = '', $mostrar_icono = true) {       
        $msg = '';
        if ($mostrar_icono) {
            $msg .= "<i class='lead " . self::$WARNING_ICON . "'></i> ";
        }
        $msg .= $content;
        $this->addFlash('warning', $msg);
    }

    /**
     * Mensaje informativo
     * 
     * @param string $content
     * @param bool $mostrar_icono
     */
    public function msgInfo($content = '', $mostrar_icono = true) {        
        $msg = '';
        if ($mostrar_icono) {
            $msg .= "<i class='lead " . self::$INFO_ICON . "'></i> ";
        }
        $msg .= $content;
        $this->addFlash('info', $msg);
    }

}
