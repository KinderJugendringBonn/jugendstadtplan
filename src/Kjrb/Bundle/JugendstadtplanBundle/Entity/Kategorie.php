<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Kategorie {

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
     * @var string $icon
     *
     * @Assert\NotBlank()
     * @ORM\Column()
     */
    private $icon;

    /**
     * @var Boolean
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="boolean")
     */
    private $sichtbar;

    public function __construct($name, $icon) {
        $this->name = $name;
        $this->icon = $icon;
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
    public function getIcon() {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon) {
        $this->icon = $icon;
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