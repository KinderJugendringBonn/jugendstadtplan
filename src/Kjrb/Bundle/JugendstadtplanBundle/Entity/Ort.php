<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kjrb\Bundle\JugendstadtplanBundle\Entity\OrtRepository")
 */
class Ort {

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
     * @var text $beschreibung
     *
     * @ORM\Column(name="beschreibung", type="text")
     */
    private $beschreibung;

    /**
     * @var float $longitude
     *
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var float $latitude
     *
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger $traeger
     *
     * @ORM\ManyToMany(targetEntity="Traeger", mappedBy="orte")
     */
    private $traeger;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot $angebot
     *
     * @ORM\OneToMany(targetEntity="Angebot", mappedBy="ort")
     */
    private $angebote;

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
     * @param \Kjrb\Bundle\JugendstadtplanBundle\Entity\text $beschreibung
     */
    public function setBeschreibung($beschreibung) {
        $this->beschreibung = $beschreibung;
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\text
     */
    public function getBeschreibung() {
        return $this->beschreibung;
    }

    /**
     * @param float $latitude
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    /**
     * @return float
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * @param float $longitude
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * @param \Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot $angebote
     */
    public function setAngebote($angebote) {
        $this->angebote = $angebote;
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot
     */
    public function getAngebote() {
        return $this->angebote;
    }

    /**
     * @param \Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger $traeger
     */
    public function setTraeger($traeger) {
        $this->traeger = $traeger;
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger
     */
    public function getTraeger() {
        return $this->traeger;
    }

}
 