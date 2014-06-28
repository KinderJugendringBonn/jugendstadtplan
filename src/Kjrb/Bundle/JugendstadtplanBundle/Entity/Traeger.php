<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kjrb\Bundle\JugendstadtplanBundle\Entity\TraegerRepository")
 */
class Traeger {

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
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Pin $pins
     *
     * @ORM\ManyToMany(targetEntity="Pin", inversedBy="traeger", indexBy="id", fetch="EAGER")
     * @ORM\JoinTable(name="traeger_pins",
     *      joinColumns={@ORM\JoinColumn(name="traeger_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pin_id", referencedColumnName="id")}
     * )
     */
    private $pins;

    public function __construct() {
        $this->pins = new ArrayCollection();
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
     * Convenience-Methode fuer das Symfony-Formularsystem.
     */
    public function setPin(Pin $pin = null) {
        if ($pin !== null) {
            $this->addPin($pin);
        }
    }

    public function addPin(Pin $pin) {
        $id = $pin->getId();
        if (!$this->pins->containsKey($id)) {
            $this->pins->set($id, $pin);
            $pin->addTraeger($this);
        }
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Pin[]
     */
    public function getPins() {
        return $this->pins;
    }

}
 