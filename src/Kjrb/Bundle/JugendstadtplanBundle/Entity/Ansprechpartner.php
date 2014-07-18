<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Ansprechpartner {

    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @Assert\NotBlank()
     * @ORM\Column()
     */
    private $name;

    /**
     * @var string $telefonnummer
     *
     * @ORM\Column(nullable=true)
     */
    private $telefonnummer;

    /**
     * @var string $mobilnummer
     *
     * @ORM\Column(nullable=true)
     */
    private $mobilnummer;

    /**
     * @var string $email
     *
     * @Assert\NotBlank()
     * @ORM\Column()
     */
    private $email;

    /**
     * @var string $bemerkung
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $bemerkung;

    /**
     * @var Pin
     *
     * @ORM\ManyToOne(targetEntity="Pin", inversedBy="ansprechpartner")
     */
    private $pin;

    /**
     * @var Traeger
     *
     * @ORM\ManyToOne(targetEntity="Traeger", inversedBy="ansprechpartner")
     */
    private $traeger;

    /**
     * @var Boolean
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean")
     */
    private $sichtbar;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
        $this->sichtbar = true;
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
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBemerkung() {
        return $this->bemerkung;
    }

    /**
     * @param string $bemerkung
     */
    public function setBemerkung($bemerkung) {
        $this->bemerkung = $bemerkung;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getMobilnummer() {
        return $this->mobilnummer;
    }

    /**
     * @param string $mobilnummer
     */
    public function setMobilnummer($mobilnummer) {
        $this->mobilnummer = $mobilnummer;
    }

    /**
     * @return string
     */
    public function getTelefonnummer() {
        return $this->telefonnummer;
    }

    /**
     * @param string $telefonnummer
     */
    public function setTelefonnummer($telefonnummer) {
        $this->telefonnummer = $telefonnummer;
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