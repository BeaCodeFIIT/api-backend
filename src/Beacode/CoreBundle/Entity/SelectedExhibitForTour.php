<?php

namespace Beacode\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SelectedExhibitForTour
 *
 * @ORM\Table(name="selected_exhibit_for_tour")
 * @ORM\Entity(repositoryClass="Beacode\CoreBundle\Repository\SelectedExhibitForTourRepository")
 */
class SelectedExhibitForTour
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
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var int
     *
     * @ORM\Column(name="event_id", type="integer")
     */
    private $eventId;

    /**
     * @var int
     *
     * @ORM\Column(name="exhibit_id", type="integer")
     */
    private $exhibitId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="system_created", type="datetime")
     */
    private $systemCreated;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return SelectedExhibitForTour
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set exhibitId
     *
     * @param integer $exhibitId
     *
     * @return SelectedExhibitForTour
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
     * Set systemCreated
     *
     * @param \DateTime $systemCreated
     *
     * @return SelectedExhibitForTour
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
     * @return SelectedExhibitForTour
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
}
