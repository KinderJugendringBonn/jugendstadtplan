<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class TraegerType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('titel')
            ->add('beschreibung', 'textarea', array('required' => false))
            ->add('pins', 'entity', array(
                'class' => 'KjrbJugendstadtplanBundle:Pin',
                'property' => 'titel',
                'multiple' => true,
                'expanded' => true,
                'required' => false
            ))
            ->add('speichern', 'submit')
        ;
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName() {
        return 'kjrb_jugendstadtplanbundle_traeger';
    }

}
