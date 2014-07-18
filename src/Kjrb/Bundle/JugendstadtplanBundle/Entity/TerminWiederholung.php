<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class TerminWiederholung {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column()
     */
    private $wochentag = 0;

    /**
     * @var integer
     *
     * 0 = jede Woche,
     * 1 = jede erste Woche des Monats,
     * 2 = jede zweite Woche des Monats,
     * 3 = jede dritte Woche des Monats,
     * 4 = jede vierte Woche des Monats,
     * 5 = jede fuenfte Woche des Monats
     *
     * @ORM\Column(type="integer")
     */
    private $wocheDesMonats;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $auchAnFeiertagen = false;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $auchInDenFerien = false;

    /**
     * @var Termin
     *
     * @ORM\ManyToOne(targetEntity="Termin", inversedBy="wiederholungen")
     */
    private $termin;

    public function __construct($wochentag) {
        $this->wochentag = $wochentag;
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
    public function getWochentag() {
        return $this->wochentag;
    }

    /**
     * @param string $wochentag
     */
    public function setWochentag($wochentag) {
        $this->wochentag = $wochentag;
    }

    /**
     * @return int
     */
    public function getWocheDesMonats() {
        return $this->wocheDesMonats;
    }

    /**
     * @param int $wocheDesMonats
     */
    public function setWocheDesMonats($wocheDesMonats) {
        $this->wocheDesMonats = $wocheDesMonats;
    }

    /**
     * @return boolean
     */
    public function isAuchAnFeiertagen() {
        return $this->auchAnFeiertagen;
    }

    /**
     * @param boolean $auchAnFeiertagen
     */
    public function setAuchAnFeiertagen($auchAnFeiertagen) {
        $this->auchAnFeiertagen = $auchAnFeiertagen;
    }

    /**
     * @return boolean
     */
    public function isAuchInDenFerien() {
        return $this->auchInDenFerien;
    }

    /**
     * @param boolean $auchInDenFerien
     */
    public function setAuchInDenFerien($auchInDenFerien) {
        $this->auchInDenFerien = $auchInDenFerien;
    }

    /**
     * @return Termin
     */
    public function getTermin() {
        return $this->termin;
    }

    /**
     * @param Termin $termin
     */
    public function setTermin(Termin $termin) {
        $this->termin = $termin;
    }

}