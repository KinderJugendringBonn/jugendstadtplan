<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kjrb\Bundle\JugendstadtplanBundle\Entity\AngebotRepository")
 */
class Angebot {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $titel
     *
     * @ORM\Column(name="titel", type="string", length=255)
     */
    private $titel;

    /**
     * @var string $beschreibung
     *
     * @ORM\Column(name="beschreibung", type="text", nullable=true)
     */
    private $beschreibung;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger $traeger
     *
     * @ORM\ManyToOne(targetEntity="Traeger", inversedBy="angebote")
     * @ORM\JoinColumn(name="traeger_id", referencedColumnName="id")
     */
    private $traeger;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort $ort
     *
     * @ORM\ManyToOne(targetEntity="Ort", inversedBy="angebote", fetch="EAGER")
     * @ORM\JoinColumn(name="ort_id", referencedColumnName="id")
     */
    private $ort;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @param string $titel
     */
    public function setTitel($titel) {
        $this->titel = $titel;
    }

    /**
     * @return string
     */
    public function getTitel() {
        return $this->titel;
    }

    /**
     * @param string $beschreibung
     */
    public function setBeschreibung($beschreibung) {
        $this->beschreibung = $beschreibung;
    }

    /**
     * @return string
     */
    public function getBeschreibung() {
        return $this->beschreibung;
    }

    public function setOrt(Ort $ort) {
        $this->ort = $ort;
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort
     */
    public function getOrt() {
        return $this->ort;
    }

    public function setTraeger(Traeger $traeger) {
        $this->traeger = $traeger;
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger
     */
    public function getTraeger() {
        return $this->traeger;
    }

}
 
