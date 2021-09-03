<?php

namespace Caja\BasicThemeBundle\Traits;

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
        $builder->add($field, ChoiceType::class, array(
            'label' => $label,
            'choices' => [
                'Si' => true,
                'No' => false,
            ],
            'expanded' => true,
            'choice_attr' => array(
                'class' => ''
            ),
            'attr' => array(
                'class' => '',
                'style' => '',
            )
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
    }

    public function addInteger(FormBuilderInterface $builder, array $options = array(), $label = 'ID', $field = 'id', $disabled = true, $min = 1, $ph = '') {
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

    public function addEmail(FormBuilderInterface $builder, array $options = array(), $label = 'Email', $field = 'email', $required = true) {
        $builder->add($field, EmailType::class, array(
            'label' => $label,
            'required' => $required,
            'attr' => array(
                'class' => 'form-control',
                'placeholder' => 'Correo electrónico de contacto',
            ),
            'constraints' => array(
                new Email(array('message' => 'Formato de correo invalido'))
            )
        ));
    }

    public function addTextDateTime(FormBuilderInterface $builder, array $options = array(), $label = 'Fecha', $field = 'fecha', $disabled = false, $title = '', $required = true) {
        $builder->add($field, DateTimeType::class, array(
            'label' => $label,
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

    public function addTextDate(FormBuilderInterface $builder, array $options = array(), $label = 'Fecha', $field = 'fecha', $disabled = false, $placeholder = 'Ingrese una fecha') {
        $builder->add($field, DateType::class, array(
            'widget' => 'single_text',
            // previene el renderizado con type="date" para prevenir el datepicker de HTML
            'html5' => false,
            'format' => 'dd/MM/yyyy',
            'label' => $label,
            'required' => false,
            'disabled' => $disabled,
            'attr' => array(
                'class' => 'js-datepicker enmascarar-fecha',
                'placeholder' => 'Fecha',
            ),
            'label_attr' => array(
                'class' => ''
            ),
        ));
    }

    public function addMesType(FormBuilderInterface $builder, array $options = array(), $label = 'Mes', $field = 'mes', $required = false, $disabled = false) {

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
            'data' => date('m'),
            'disabled' => $disabled
        );

        $builder->add($field, ChoiceType::class, $conf);
    }

}
