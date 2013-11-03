<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class OrtType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('titel')
            ->add('beschreibung', 'textarea', array('required' => false))
            ->add('longitude')
            ->add('latitude')
            ->add('speichern', 'submit')
        ;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName() {
        return 'kjrb_jugendstadtplanbundle_ort';
    }


}
 