<?php

namespace Beacode\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Beacon
 *
 * @ORM\Table(name="beacon")
 * @ORM\Entity(repositoryClass="Beacode\CoreBundle\Repository\BeaconRepository")
 */
class Beacon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="event_id", type="integer", nullable=true)
     */
    private $eventId;

    /**
     * @var int
     *
     * @ORM\Column(name="exhibit_id", type="integer", nullable=true)
     */
    private $exhibitId;

    /**
     * @var string
     *
     * @ORM\Column(name="UUID", type="string", length=255)
     */
    private $UUID;

    /**
     * @var int
     *
     * @ORM\Column(name="major", type="integer")
     */
    private $major;

    /**
     * @var int
     *
     * @ORM\Column(name="minor", type="integer")
     */
    private $minor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="system_created", type="datetime")
     */
    private $systemCreated;

    /**
     * @var float
     *
     * @ORM\Column(name="coor_x", type="float", nullable=true)
     */
    private $coorX;

    /**
     * @var float
     *
     * @ORM\Column(name="coor_y", type="float", nullable=true)
     */
    private $coorY;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set exhibitId
     *
     * @param integer $exhibitId
     *
     * @return Beacon
     */
    public function setExhibitId($exhibitId)
    {
        $this->exhibitId = $exhibitId;

        return $this;
    }

    /**
     * Get exhibitId
     *
     * @return int
     */
    public function getExhibitId()
    {
        return $this->exhibitId;
    }

    /**
     * Set UUID
     *
     * @param integer $UUID
     *
     * @return Beacon
     */
    public function setUUID($UUID)
    {
        $this->UUID = $UUID;

        return $this;
    }

    /**
     * Get UUID
     *
     * @return int
     */
    public function getUUID()
    {
        return $this->UUID;
    }

    /**
     * Set major
     *
     * @param integer $major
     *
     * @return Beacon
     */
    public function setMajor($major)
    {
        $this->major = $major;

        return $this;
    }

    /**
     * Get major
     *
     * @return int
     */
    public function getMajor()
    {
        return $this->major;
    }

    /**
     * Set minor
     *
     * @param integer $minor
     *
     * @return Beacon
     */
    public function setMinor($minor)
    {
        $this->minor = $minor;

        return $this;
    }

    /**
     * Get minor
     *
     * @return int
     */
    public function getMinor()
    {
        return $this->minor;
    }

    /**
     * Set systemCreated
     *
     * @param \DateTime $systemCreated
     *
     * @return Beacon
     */
    public function setSystemCreated($systemCreated)
    {
        $this->systemCreated = $systemCreated;

        return $this;
    }

    /**
     * Get systemCreated
     *
     * @return \DateTime
     */
    public function getSystemCreated()
    {
        return $this->systemCreated;
    }

    /**
     * Set eventId
     *
     * @param integer $eventId
     *
     * @return Beacon
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set coorX
     *
     * @param float $coorX
     *
     * @return Beacon
     */
    public function setCoorX($coorX)
    {
        $this->coorX = $coorX;

        return $this;
    }

    /**
     * Get coorX
     *
     * @return float
     */
    public function getCoorX()
    {
        return $this->coorX;
    }

    /**
     * Set coorY
     *
     * @param float $coorY
     *
     * @return Beacon
     */
    public function setCoorY($coorY)
    {
        $this->coorY = $coorY;

        return $this;
    }

    /**
     * Get coorY
     *
     * @return float
     */
    public function getCoorY()
    {
        return $this->coorY;
    }
}
