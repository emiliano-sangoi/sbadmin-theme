<?php

namespace Caja\SBAdminThemeBundle\Traits;

use Caja\UtilsBundle\Util\Util;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Este trait contiene metodos para crear facilmente campos que son comunes en los formularios.
 * 
 * Cada campo deberia dar cierta posibilidad de configurar pero la idea es que se use con la configuracion
 * por defecto y en caso de necesitar cierta configuracion especifica el campo deberia crearse manualmente
 * en el formulario que lo necesite.
 * 
 * @author esangoi
 */
trait FormFieldsHelperTrait {

    public function addActivo(FormBuilderInterface $builder, array $options = array(), $label = '¿Activo?', $field = 'activo') {
        
        $opt = array(
            'Si' => true,
            'No' => false);
            
        $builder->add($field, ChoiceType::class, array(
            'label' => $label,
            'choices' => $opt,
            'expanded' => true,
            'choice_attr' => array(
                'class' => ''
            ),
            'attr' => array(
                'class' => '',
                'style' => '',
            ),
            'data' => $opt['Si'],
            
        ));
    }

    public function addCuit(FormBuilderInterface $builder, array $options = array(), $label = 'CUIL', $field = 'cuil', $required = false) {

        $conf = array(
            'label' => $label,
            'required' => $required,
            'attr' => array(
                'class' => 'form-control enmascarar-cuit',
                'placeholder' => 'CUIL'
            )
        );

        if ($required) {
            $conf['constraints'][] = new NotBlank(array(
                'message' => 'Campo obligatorio'
            ));
        }

        $builder->add($field, TextType::class, $conf);
        $this->setDataTransformers($builder, $options);
    }

    public function addInteger(FormBuilderInterface $builder, array $options = array(), $label = 'ID', $field = 'id', $disabled = true, $min = 1, $ph = '', $max = false) {
        $conf = array(
            'label' => $label,
            'disabled' => $disabled,
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => $ph
            )
        );

        if (is_int($min)) {
            $conf['attr']['min'] = $min;
        }
        if (is_int($max)) {
            $conf['attr']['max'] = $max;
        }
        
        $builder->add($field, IntegerType::class, $conf);
    }

    public function addDescripcion(FormBuilderInterface $builder, array $options = array(), $rows = 5, $required = false) {
        $builder->add('descripcion', TextareaType::class, array(
            'label' => 'Descripción',
            'required' => $required,
            'attr' => array(
                'placeholder' => 'Ingrese una descripción',
                'class' => 'form-control',
                'rows' => $rows
            )
        ));
    }

    public function addUrl(FormBuilderInterface $builder, array $options = array(), $label = '¿Activo?', $field = 'url', $required = false) {
        $builder->add($field, UrlType::class, array(
            'label' => $label,
            'required' => $required,
            'attr' => array(
                'placeholder' => '',
                'class' => 'form-control'
            )
        ));
    }

    public function addEmail(FormBuilderInterface $builder, array $options = array(), $label = 'Email', $field = 'email', $required = true, $disabled = false) {
        
        $config = array(
            'label' => $label,
            'required' => $required,
            'disabled' => $disabled,
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Correo electrónico de contacto',
            ),
            'constraints' => array(
                new Email(array('message' => 'Formato de correo invalido'))
            )
        );
        
        if($required){
            $config['constraints'][] = new NotBlank(array(
                'message' => 'Campo obligatorio'
            ));
        }
        
        
        $builder->add($field, EmailType::class, $config);
    }

    public function addTextDateTime(FormBuilderInterface $builder, array $options = array(), $label = 'Fecha', $field = 'fecha', $disabled = false, $title = '', $required = true) {
        if(!empty($options)){
            $builder->add($field, DateTimeType::class, $options);
        }else{
            $builder->add($field, DateTimeType::class, array(
                'label' => $label,
                'label_attr' => array('class' => 'form-label'),
                'required' => $required,
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy HH:mm',
                'attr' => array(
                    'class' => 'form-control',
                    'title' => $title
                ),
                'disabled' => $disabled
            ));

        }
    }

    public function addTextDate(FormBuilderInterface $builder, array $options = array(), $label = 'Fecha', $field = 'fecha', $disabled = false, $placeholder = 'Ingrese una fecha', $required = false) {
        $builder->add($field, DateType::class, array(
            'widget' => 'single_text',
            // previene el renderizado con type="date" para prevenir el datepicker de HTML
            'html5' => false,
            'format' => 'dd/MM/yyyy',
            'label' => $label,
            'required' => $required,
            'disabled' => $disabled,
            'attr' => array(
                'class' => 'js-datepicker enmascarar-fecha',
                
                //Esto es para desactivar la sugerencia de Chrome: 
                // Sacado de https://stackoverflow.com/questions/37595141/disable-chrome-autofill-creditcard
                'autocomplete' => 'cc-csc',
                
                'placeholder' => 'Fecha',
            ),
            'label_attr' => array(
                'class' => ''
            ),
        ));
    }

    public function addMesType(FormBuilderInterface $builder, array $options = array(), $label = 'Mes', $field = 'mes', $required = false, $disabled = false, $data = null) {
        
        $meses = array(
            'Enero' => '01',
            'Febrero' => '02',
            'Marzo' => '03',
            'Abril' => '04',
            'Mayo' => '05',
            'Junio' => '06',
            'Julio' => '07',
            'Agosto' => '08',
            'Septiembre' => '09',
            'Octubre' => '10',
            'Noviembre' => '11',
            'Diciembre' => '12'
        );

        $conf = array(
            'choices' => $meses,
            'label' => $label,
            'required' => $required,
            'label_attr' => array(
                'class' => 'font-weight-bold'
            ),
            'attr' => array('class' => 'select2-basico form-control'),
            'multiple' => false,
            'expanded' => false,            
            'disabled' => $disabled,
            'data' => $data,
        );

        $builder->add($field, ChoiceType::class, $conf);
    }

    
      /**
     * Setea los Model y View Transformers.
     *
     * @param FormBuilderInterface $builder [description]
     * @param array                $options [description]
     */
    public function setDataTransformers(FormBuilderInterface $builder, array $options) {

        //$builder->get('fechaAprobacion')->addViewTransformer();
        $builder->get('cuil')->addViewTransformer(
                new CallbackTransformer(
                function ($cuilSinGuiones) {
            // conversion: modelo -> vista
            return $cuilSinGuiones;
        }, function ($cuilConGuiones) {
            // conversion: 12-12121212-1 -> 12121212121
            return Util::sanitizeCUIT($cuilConGuiones);
        }
        ));
    }
}
