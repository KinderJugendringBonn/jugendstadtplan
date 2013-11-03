<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

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
     * @var text $beschreibung
     *
     * @ORM\Column(name="beschreibung", type="text", nullable=true)
     */
    private $beschreibung;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort $orte
     *
     * @ORM\ManyToMany(targetEntity="Ort", inversedBy="traeger")
     * @ORM\JoinTable(name="traeger_orte",
     *      joinColumns={@ORM\JoinColumn(name="traeger_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="ort_id", referencedColumnName="id")}
     * )
     */
    private $orte;

    /**
     * @var \Kjrb\Bundle\JugendstadtplanBundle\Entity\Angebot $angebote
     *
     * @ORM\OneToMany(targetEntity="Angebot", mappedBy="traeger")
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
     * @param \Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort $orte
     */
    public function setOrte($orte) {
        $this->orte = $orte;
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Ort
     */
    public function getOrte() {
        return $this->orte;
    }

}
 