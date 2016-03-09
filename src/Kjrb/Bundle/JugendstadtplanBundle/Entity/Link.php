<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Link {

    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $titel
     *
     * @Assert\NotBlank()
     * @ORM\Column()
     */
    private $titel;

    /**
     * @var string $url
     *
     * @Assert\NotBlank()
     * @ORM\Column()
     */
    private $url;

    /**
     * @var Pin
     *
     * @ORM\ManyToOne(targetEntity="Pin", inversedBy="links")
     */
    private $pin;

    /**
     * @var Traeger
     *
     * @ORM\ManyToOne(targetEntity="Traeger", inversedBy="links")
     */
    private $traeger;

    /**
     * @var Boolean
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean")
     */
    private $sichtbar;

    public function __construct($titel, $url) {
        $this->titel = $titel;
        $this->url = $url;
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
    public function getTitel() {
        return $this->titel;
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
    public function getUrl() {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url) {
        $this->url = $url;
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
    public function setPin(Pin $pin = null) {
        $this->pin = $pin;
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
    public function setTraeger(Traeger $traeger = null) {
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