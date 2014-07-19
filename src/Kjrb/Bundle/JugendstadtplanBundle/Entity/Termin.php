<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Termin {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $beginn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $ende;

    /**
     * @var bool $ganztaegig
     *
     * @ORM\Column(type="boolean")
     */
    private $ganztaegig;

    /**
     * @var TerminWiederholung[]
     *
     * @ORM\OneToMany(targetEntity="TerminWiederholung", mappedBy="termin", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    private $wiederholungen;

    /**
     * @var Pin
     *
     * @ORM\ManyToOne(targetEntity="Pin", inversedBy="termine")
     */
    private $pin;

    public function __construct(\DateTime $beginn) {
        $this->beginn = $beginn;
        $this->wiederholungen = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getBeginn() {
        return $this->beginn;
    }

    /**
     * @param \DateTime $beginn
     */
    public function setBeginn(\DateTime $beginn) {
        $this->beginn = $beginn;
    }

    /**
     * @return \DateTime
     */
    public function getEnde() {
        return $this->ende;
    }

    /**
     * @param \DateTime $ende
     */
    public function setEnde(\DateTime $ende) {
        $this->ende = $ende;
    }

    /**
     * @return boolean
     */
    public function isGanztaegig() {
        return $this->ganztaegig;
    }

    /**
     * @param boolean $ganztaegig
     */
    public function setGanztaegig($ganztaegig) {
        $this->ganztaegig = $ganztaegig;
    }

    /**
     * @return TerminWiederholung
     */
    public function getWiederholungen() {
        return $this->wiederholungen;
    }

    /**
     * @param TerminWiederholung $wiederholung
     */
    public function addWiederholung(TerminWiederholung $wiederholung) {
        $id = $wiederholung->getId();
        if (!$id) {
            $this->wiederholungen->add($wiederholung);
        } elseif (!$this->wiederholungen->containsKey($id)) {
            $this->wiederholungen->set($id, $wiederholung);
        }
        $wiederholung->setTermin($this);
    }

    /**
     * @return Pin
     */
    public function getPin() {
        return $this->pin;
    }

    /**
     * @param Pin $pin
     */
    public function setPin(Pin $pin) {
        $this->pin = $pin;
    }

}