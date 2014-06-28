<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Translation\TranslatorInterface;

class PinType extends AbstractType {

    protected $translator;

    public function __construct(TranslatorInterface $translator) {
        $this->translator = $translator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('titel')
            ->add('beschreibung', 'textarea', array('required' => false))
            ->add('longitude')
            ->add('latitude')
            ->add('traeger', 'entity', array(
                'class' => 'KjrbJugendstadtplanBundle:Traeger',
                'property' => 'titel',
                'empty_value' => $this->translator->trans('pin.option.kein_traeger'),
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
        return 'kjrb_jugendstadtplanbundle_pin';
    }


}
 