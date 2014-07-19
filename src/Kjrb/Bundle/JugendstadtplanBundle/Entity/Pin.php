<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kjrb\Bundle\JugendstadtplanBundle\Entity\PinRepository")
 */
class Pin {

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
     * @var Kategorie
     *
     * @Assert\NotBlank()
     * @ORM\OneToOne(targetEntity="Kategorie")
     */
    private $kategorie;

    /**
     * @var string $beschreibung
     *
     * @ORM\Column(name="beschreibung", type="text", nullable=true)
     */
    private $beschreibung;

    /**
     * @var Adresse
     *
     * @ORM\OneToOne(targetEntity="Adresse", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    private $adresse;

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
     * @var string
     *
     * @ORM\Column(nullable=true)
     */
    private $barrierefreiheit;

    /**
     * @var string "Kostenlos" | "Kostenpflichtig"
     *
     * @ORM\Column(nullable=true)
     */
    private $kostenArt;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $kostenBemerkung;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $anmeldepflichtig = false;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $anmeldepflichtBemerkung;

    /**
     * @var string
     *
     * @ORM\Column(nullable=true)
     */
    private $mindestalter;

    /**
     * @var Ansprechpartner[]
     *
     * @ORM\OneToMany(targetEntity="Ansprechpartner", mappedBy="pin", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    private $ansprechpartner;

    /**
     * @var Termin[]
     *
     * @ORM\OneToMany(targetEntity="Termin", mappedBy="pin", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    private $termine;

    /**
     * @var Link[]
     *
     * @ORM\OneToMany(targetEntity="Link", mappedBy="pin", indexBy="id", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    private $links;

    /**
     * @var Bild[]
     *
     * @ORM\OneToMany(targetEntity="Bild", mappedBy="pin", indexBy="id", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    private $bilder;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger $traeger
     *
     * @ORM\ManyToOne(targetEntity="Traeger", inversedBy="pins", fetch="EAGER")
     */
    private $traeger;

    public function __construct() {
        $this->ansprechpartner = new ArrayCollection();
        $this->termine = new ArrayCollection();
        $this->links = new ArrayCollection();
        $this->bilder = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
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
     * @return Adresse
     */
    public function getAdresse() {
        return $this->adresse;
    }

    /**
     * @param Adresse $adresse
     */
    public function setAdresse(Adresse $adresse) {
        $this->adresse = $adresse;
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
     * @return string
     */
    public function getBarrierefreiheit() {
        return $this->barrierefreiheit;
    }

    /**
     * @param string $barrierefreiheit
     */
    public function setBarrierefreiheit($barrierefreiheit) {
        $this->barrierefreiheit = $barrierefreiheit;
    }

    /**
     * @return string
     */
    public function getKostenArt() {
        return $this->kostenArt;
    }

    /**
     * @param string $kostenArt "Kostenlos" | "Kostenpflichtig"
     */
    public function setKostenArt($kostenArt) {
        $this->kostenArt = $kostenArt;
    }

    /**
     * @return string
     */
    public function getKostenBemerkung() {
        return $this->kostenBemerkung;
    }

    /**
     * @param string $kostenBemerkung
     */
    public function setKostenBemerkung($kostenBemerkung) {
        $this->kostenBemerkung = $kostenBemerkung;
    }

    /**
     * @return boolean
     */
    public function isAnmeldepflichtig() {
        return $this->anmeldepflichtig;
    }

    /**
     * @param boolean $anmeldepflichtig
     */
    public function setAnmeldepflichtig($anmeldepflichtig) {
        $this->anmeldepflichtig = $anmeldepflichtig;
    }

    /**
     * @return string
     */
    public function getAnmeldepflichtBemerkung() {
        return $this->anmeldepflichtBemerkung;
    }

    /**
     * @param string $anmeldepflichtBemerkung
     */
    public function setAnmeldepflichtBemerkung($anmeldepflichtBemerkung) {
        $this->anmeldepflichtBemerkung = $anmeldepflichtBemerkung;
    }

    /**
     * @return string
     */
    public function getMindestalter() {
        return $this->mindestalter;
    }

    /**
     * @param string $mindestalter
     */
    public function setMindestalter($mindestalter) {
        $this->mindestalter = $mindestalter;
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
        $ansprechpartner->setPin($this);
    }

    /**
     * @return Termin[]
     */
    public function getTermine() {
        return $this->termine;
    }

    public function deleteAllTermine() {
        $this->termine = new ArrayCollection();
    }

    /**
     * @param Termin $termin
     */
    public function addTermin(Termin $termin) {
        $id = $termin->getId();
        if (!$id) {
            $this->termine->add($termin);
        } elseif (!$this->termine->containsKey($id)) {
            $this->termine->set($id, $termin);
        }
        $termin->setPin($this);
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
        $link->setPin($this);
    }

    /**
     * @return Bild[]
     */
    public function getBilder() {
        return $this->bilder;
    }

    public function deleteAllBilder() {
        $this->bilder = new ArrayCollection();
    }

    /**
     * @param Bild
     */
    public function addBild(Bild $bild) {
        $id = $bild->getId();
        if (!$id) {
            $this->bilder->add($bild);
        } elseif (!$this->bilder->containsKey($id)) {
            $this->bilder->set($id, $bild);
        }
        $bild->setPin($this);
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