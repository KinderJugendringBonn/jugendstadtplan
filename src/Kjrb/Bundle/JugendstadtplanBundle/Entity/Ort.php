<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
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
     * @var float $longitude
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="longitude", type="float")
     */
    private $longitude;

    /**
     * @var float $latitude
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="latitude", type="float")
     */
    private $latitude;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger $traeger
     *
     * @ORM\ManyToMany(targetEntity="Traeger", mappedBy="orte", indexBy="id")
     */
    private $traeger;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot $angebot
     *
     * @ORM\OneToMany(targetEntity="Angebot", mappedBy="ort", indexBy="id")
     */
    private $angebote;

    public function __construct() {
        $this->traeger = new ArrayCollection();
        $this->angebote = new ArrayCollection();
    }

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
     * Convenience-Methode fuer das Symfony-Formularsystem.
     */
    public function setAngebote(Angebot $angebot) {
        $this->addAngebot($angebot);
    }

    public function addAngebot(Angebot $angebot) {
        $id = $angebot->getId();
        if (!$this->angebote->containsKey($id)) {
            $this->angebote->set($id, $angebot);
            $angebot->setOrt($this);
        }
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot[]
     */
    public function getAngebote() {
        return $this->angebote;
    }

    /**
     * Convenience-Methode fuer das Symfony-Formularsystem.
     */
    public function setTraeger(Traeger $traeger = null) {
        if ($traeger !== null) {
            $this->addTraeger($traeger);
        }
    }

    public function addTraeger(Traeger $traeger) {
        $id = $traeger->getId();
        if (!$this->traeger->containsKey($id)) {
            $this->traeger->set($id, $traeger);
            $traeger->addOrt($this);
        }
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger[]
     */
    public function getTraeger() {
        return $this->traeger;
    }

    public function toJson() {
        return json_encode(get_object_vars($this));
    }

}
 