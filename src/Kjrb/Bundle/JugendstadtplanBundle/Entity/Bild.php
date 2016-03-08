<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Bild {

    /**
     * @var integer $id
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $fileName
     *
     * @ORM\Column()
     */
    private $fileName;

    /**
     * @var string $filePath
     *
     * @ORM\Column(nullable=true)
     */
    private $filePath;

    /**
     * @var string $fileType
     *
     * @ORM\Column(nullable=true)
     */
    private $fileType;

    /**
     * @var integer $fileSize
     *
     * @ORM\Column(type="integer")
     */
    private $fileSize;

    /**
     * @var \DateTime $fileChangetime;
     *
     * @ORM\Column(type="datetime")
     */
    private $fileChangetime;

    /**
     * @var string $alt
     *
     * @ORM\Column(nullable=true)
     */
    private $alt;

    /**
     * @var string $caption
     *
     * @ORM\Column(nullable=true)
     */
    private $caption;

    /**
     * @var Pin $pin
     *
     * @ORM\ManyToOne(targetEntity="Pin", inversedBy="bilder")
     */
    private $pin;

    /**
     * @var Traeger $traeger
     *
     * @ORM\ManyToOne(targetEntity="Traeger", inversedBy="bilder")
     */
    private $traeger;

    /**
     * @var string $tmpName
     *
     * Brauchen wir nur, um den temporaeren Namen der Bilddatei zu transportieren. Muss nicht persistiert werden.
     */
    private $tmpName;

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
    public function getFileName() {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     */
    public function setFileName($fileName) {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFilePath() {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath($filePath) {
        $this->filePath = $filePath;
    }

    /**
     * @return int
     */
    public function getFileSize() {
        return $this->fileSize;
    }

    /**
     * @param int $fileSize
     */
    public function setFileSize($fileSize) {
        $this->fileSize = $fileSize;
    }

    /**
     * @return \DateTime
     */
    public function getFileChangetime() {
        return $this->fileChangetime;
    }

    /**
     * @param \DateTime $fileChangetime
     */
    public function setFileChangetime($fileChangetime) {
        $this->fileChangetime = $fileChangetime;
    }

    /**
     * @return string
     */
    public function getFileType() {
        return $this->fileType;
    }

    /**
     * @param string $fileType
     */
    public function setFileType($fileType) {
        $this->fileType = $fileType;
    }

    /**
     * @return string
     */
    public function getAlt() {
        return $this->alt;
    }

    /**
     * @param string $alt
     */
    public function setAlt($alt) {
        $this->alt = $alt;
    }

    /**
     * @return string
     */
    public function getCaption() {
        return $this->caption;
    }

    /**
     * @param string $caption
     */
    public function setCaption($caption) {
        $this->caption = $caption;
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
     * @return string
     */
    public function getTmpName() {
        return $this->tmpName;
    }

    /**
     * @param string $tmpName
     */
    public function setTmpName($tmpName) {
        $this->tmpName = $tmpName;
    }

}