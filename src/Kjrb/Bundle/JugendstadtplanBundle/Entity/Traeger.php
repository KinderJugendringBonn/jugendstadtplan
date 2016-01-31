<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_TRAEGER_EMAIL", columns={"email"})})
 * @ORM\Entity(repositoryClass="Kjrb\Bundle\JugendstadtplanBundle\Entity\TraegerRepository")
 */
class Traeger implements AdvancedUserInterface, \Serializable
{

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
     * @ORM\Column(unique=true)
     */
    private $email;

    /**
     * @var string password
     *
     * @ORM\Column()
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

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

    /**
     * @var Bild[] $bilder
     *
     * @ORM\OneToMany(targetEntity="Bild", mappedBy="traeger", indexBy="id", cascade={"all"}, orphanRemoval=true, fetch="EAGER")
     */
    private $bilder;

    public function __construct($email) {
        $this->email = $email;
        $this->isActive = true;
        $this->pins = new ArrayCollection();
        $this->adressen = new ArrayCollection();
        $this->ansprechpartner = new ArrayCollection();
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
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        $this->password = $password;
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
        if (!$id) {
            $this->pins->add($pin);
        } elseif (!$this->pins->containsKey($id)) {
            $this->pins->set($id, $pin);
        }
        $pin->setTraeger($this);
    }

    /**
     * @return \Kjrb\Bundle\JugendstadtplanBundle\Entity\Pin[]
     */
    public function getPins() {
        return $this->pins;
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
     * @param Bild $bild
     */
    public function addBild(Bild $bild) {
        $id = $bild->getId();
        if (!$id) {
            $this->bilder->add($bild);
        } elseif(!$this->bilder->containsKey($id)) {
            $this->bilder->set($id, $bild);
        }
        $bild->setTraeger($this);
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->isActive
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->isActive
            ) = unserialize($serialized);
    }

    public function getRoles()
    {
        return array('ROLE_TRAEGER');
    }

    /**
     * No salt needed, when using bcrypt. @see https://github.com/symfony/symfony-docs/blob/2.8/cookbook/security/entity_provider.rst#creating-your-first-user
     *
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

}
 