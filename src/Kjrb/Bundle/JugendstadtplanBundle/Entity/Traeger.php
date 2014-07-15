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
     * @var string $email
     *
     * @ORM\Column()
     */
    private $email;

    /**
     * @var string hash
     *
     * @ORM\Column()
     */
    private $hash;

    private $pepper = 'lkneeee# nn';

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
     * @var Kategorie
     *
     * @ORM\ManyToOne(targetEntity="Kategorie", fetch="EAGER")
     */
    private $kategorie;

    /**
     * @var Adresse[]
     *
     * @ORM\OneToMany(targetEntity="Adresse", mappedBy="traeger", cascade={"all"}, orphanRemoval=true, indexBy="id", fetch="EAGER")
     */
    private $adressen;

    /**
     * @var Ansprechpartner[]
     *
     * @ORM\OneToMany(targetEntity="Ansprechpartner", mappedBy="traeger", cascade={"all"}, orphanRemoval=true, indexBy="id", fetch="EAGER")
     */
    private $ansprechpartner;

    /**
     * @var Link[]
     *
     * @ORM\OneToMany(targetEntity="Link", mappedBy="traeger", indexBy="id", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    private $links;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Pin $pins
     *
     * @ORM\OneToMany(targetEntity="Pin", mappedBy="traeger", indexBy="id", orphanRemoval=true, fetch="EAGER")
     */
    private $pins;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->hash = $this->getPasswordHash($password);
        $this->pins = new ArrayCollection();
        $this->adressen = new ArrayCollection();
        $this->ansprechpartner = new ArrayCollection();
        $this->links = new ArrayCollection();
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
    public function getHash() {
        return $this->hash;
    }

    /**
     * @param string $hash
     */
    public function setHash($hash) {
        $this->hash = $hash;
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
     * @return Kategorie
     */
    public function getKategorie() {
        return $this->kategorie;
    }

    /**
     * @param Kategorie $kategorie
     */
    public function setKategorie(Kategorie $kategorie) {
        $this->kategorie = $kategorie;
    }

    /**
     * @return Adresse[]
     */
    public function getAdressen() {
        return $this->adressen;
    }

    public function deleteAllAdressen() {
        $this->adressen = new ArrayCollection();
    }

    /**
     * @param Adresse[] $adressen
     */
    public function addAdresse(Adresse $adresse) {
        $id = $adresse->getId();
        if (!$id) {
            $this->adressen->add($adresse);
        } elseif (!$this->adressen->containsKey($id)) {
            $this->adressen->set($id, $adresse);
        }
        $adresse->setTraeger($this);
    }

    /**
     * @return Link[]
     */
    public function getLinks() {
        return $this->links;
    }

    public function deleteAllLinks() {
        $this->links = new ArrayCollection();
    }

    /**
     * @param Link
     */
    public function addLink(Link $link) {
        $id = $link->getId();
        if (!$id) {
            $this->links->add($link);
        } elseif (!$this->links->containsKey($id)) {
            $this->links->set($id, $link);
        }
        $link->setTraeger($this);
    }

    /**
     * @return Ansprechpartner[]
     */
    public function getAnsprechpartner() {
        return $this->ansprechpartner;
    }

    public function deleteAllAnsprechpartner() {
        $this->ansprechpartner = new ArrayCollection();
    }

    /**
     * @param Ansprechpartner $ansprechpartner
     */
    public function addAnsprechpartner(Ansprechpartner $ansprechpartner) {
        $id = $ansprechpartner->getId();
        if (!$id) {
            $this->ansprechpartner->add($ansprechpartner);
        } elseif(!$this->ansprechpartner->containsKey($id)) {
            $this->ansprechpartner->set($id, $ansprechpartner);
        }
        $ansprechpartner->setTraeger($this);
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
        if (!$id || !$this->pins->containsKey($id)) {
            $this->pins->set($id, $pin);
            $pin->setTraeger($this);
        }
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Pin[]
     */
    public function getPins() {
        return $this->pins;
    }

    public function setPassword($password) {
        $this->setHash($this->getPasswordHash($password));
    }

    public function isValidPassword($password) {
        return $this->getPasswordHash($password) == $this->hash;
    }

    private function getPasswordHash($password) {
        // @see http://php.net/crypt zur Erläuterung des Blowfish-spezifischen $cryptSalt
        $blowFishSignal = '$2a$';
        $blowFishCostParameter = 10;
        $salt = substr(uniqid() . uniqid(), 0, 22); // Salz via Zufallsgenerator; Länge auf 22 Zeichen begrenzt, da Blowfish nicht mehr verwendet
        $cryptSalt = $blowFishSignal . $blowFishCostParameter . '$' . $salt;
        $encrypted = crypt($password . $this->pepper, $cryptSalt);

        return $encrypted;
    }

}
 