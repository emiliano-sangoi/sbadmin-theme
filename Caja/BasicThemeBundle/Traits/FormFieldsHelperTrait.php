<?php

namespace Caja\BasicThemeBundle\Traits;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;

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

    public function addCuit(FormBuilderInterface $builder, array $options = array(), $label = '¿Activo?', $field = 'activo') {
        $builder->add('cuil', TextType::class, array(
            'label' => 'CUIL',
            'attr' => array(
                'class' => 'form-control'
            )
        ));
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

        if(is_int($min)){
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

    public function addEmail(FormBuilderInterface $builder, array $options = array(), $label = 'Email', $field = 'email') {
        $builder->add($field, EmailType::class, array(
            'label' => $label,
            'attr' => array(
                'class' => 'form-control'
            )
        ));
    }

    public function addTextDateTime(FormBuilderInterface $builder, array $options = array(), $label = 'Fecha', $field = 'fecha', $disabled = false, $title = '') {
        $builder->add($field, DateTimeType::class, array(
            'label' => $label,
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
