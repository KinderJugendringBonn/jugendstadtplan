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
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort $orte
     *
     * @ORM\ManyToMany(targetEntity="Ort", inversedBy="traeger", indexBy="id")
     * @ORM\JoinTable(name="traeger_orte",
     *      joinColumns={@ORM\JoinColumn(name="traeger_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ort_id", referencedColumnName="id")}
     * )
     */
    private $orte;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot $angebote
     *
     * @ORM\OneToMany(targetEntity="Angebot", mappedBy="traeger", indexBy="id")
     */
    private $angebote;

    public function __construct() {
        $this->orte = new ArrayCollection();
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
     * Convenience-Methode fuer das Symfony-Formularsystem.
     */
    public function setAngebote(Angebot $angebot) {
        $this->addAngebot($angebot);
    }

    public function addAngebot(Angebot $angebot) {
        $id = $angebot->getId();
        if (!$this->angebote->containsKey($id)) {
            $this->angebote->set($id, $angebot);
            $angebot->setTraeger($this);
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
    public function setOrt(Ort $ort) {
        $this->addOrt($ort);
    }

    public function addOrt(Ort $ort) {
        $id = $ort->getId();
        if (!$this->orte->containsKey($id)) {
            $this->orte->set($id, $ort);
            $ort->addTraeger($this);
        }
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort[]
     */
    public function getOrte() {
        return $this->orte;
    }

}
 