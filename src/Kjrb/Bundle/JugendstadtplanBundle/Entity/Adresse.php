<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Adresse {

    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $strasse
     *
     * @Assert\NotBlank()
     * @ORM\Column()
     */
    private $strasse;

    /**
     * @var string $plz
     *
     * @ORM\Column(nullable=true)
     */
    private $plz;

    /**
     * @var string $ort
     *
     * @Assert\NotBlank()
     * @ORM\Column()
     */
    private $ort;

    /**
     * @var Traeger
     *
     * @ORM\ManyToOne(targetEntity="Traeger", inversedBy="adressen")
     */
    private $traeger;

    /**
     * @var Boolean
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean")
     */
    private $sichtbar;

    public function __construct($strasse, $ort) {
        $this->strasse = $strasse;
        $this->ort = $ort;
        $this->sichtbar = true;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getOrt() {
        return $this->ort;
    }

    /**
     * @param string $ort
     */
    public function setOrt($ort) {
        $this->ort = $ort;
    }

    /**
     * @return string
     */
    public function getPlz() {
        return $this->plz;
    }

    /**
     * @param string $plz
     */
    public function setPlz($plz) {
        $this->plz = $plz;
    }

    /**
     * @return string
     */
    public function getStrasse() {
        return $this->strasse;
    }

    /**
     * @param string $strasse
     */
    public function setStrasse($strasse) {
        $this->strasse = $strasse;
    }

    /**
     * @return Traeger
     */
    public function getTraeger() {
        return $this->traeger;
    }

    /**
     * @param Traeger $traeger
     */
    public function setTraeger(Traeger $traeger) {
        $this->traeger = $traeger;
    }

    /**
    /**
     * @return boolean
     */
    public function isSichtbar() {
        return $this->sichtbar;
    }

    /**
     * @param boolean $sichtbar
     */
    public function setSichtbar($sichtbar) {
        $this->sichtbar = $sichtbar;
    }

}