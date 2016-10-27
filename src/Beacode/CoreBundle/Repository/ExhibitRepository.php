<?php

namespace Beacode\CoreBundle\Repository;
use Beacode\CoreBundle\Entity\Exhibit;
use Doctrine\ORM\EntityRepository;

/**
 * ExhibitRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ExhibitRepository extends EntityRepository {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Exhibit|int|null|object
     */
    public function createExhibit($data) {
        $object = $this->getExhibit($data);
        if (!empty($object)) return 0;

        $object = new Exhibit();
        $data['systemCreated'] = new \DateTime();
        $object = $this->getExhibitObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Exhibit|null $object
     * @return Exhibit|int|null|object
     */
    public function editExhibit($data, Exhibit $object=null) {
        if (empty($object)) {
            $object = $this->getExhibit($data);
            if (empty($object)) return 0;
        }

        $object = $this->getExhibitObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Exhibit|int|null|object
     */
    public function upsertExhibit($data) {
        $object = $this->getExhibit($data);
        if (empty($object)) {
            $object = $this->createExhibit($data);
        } else {
            $object = $this->editExhibit($data, $object);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Exhibit|null $object
     * @return int
     */
    public function removeExhibit($data, Exhibit $object=null) {
        if (empty($object)) {
            $object = $this->getExhibit($data);
            if (empty($object)) return 0;
        }

        $this->_em->remove($object);

        $this->_em->flush();

        return 1;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return null|object
     */
    public function getExhibit($data) {
        $object = null;

        if (!empty($data['id'])) {
            $object = $this->findOneBy(['id'=>$data['id']]);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Exhibit $object
     * @param $data
     * @return Exhibit
     */
    private function getExhibitObjectFromData(Exhibit $object, $data) {
        if (!empty($data['eventId'])) $object->setEventId($data['eventId']);
        if (!empty($data['name'])) $object->setName($data['name']);
        if (!empty($data['description'])) $object->setDescription($data['description']);
        if (!empty($data['systemCreated'])) $object->setSystemCreated($data['systemCreated']);

        $this->_em->persist($object);

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Exhibit $object
     * @param $forFunction
     * @return array
     */
    public function getExhibitDataFromObject(Exhibit $object, $forFunction) {
        $whichData = [];
        if ($forFunction == 1) $whichData = [1];

        $data = [];
        if (in_array(1, $whichData)) {
            $data['id'] = $object->getId();
        }
        if (in_array(2, $whichData)) {
            $data['eventId'] = $object->getEventId();
            $data['name'] = $object->getName();
            $data['description'] = $object->getDescription();
        }

        return $data;
    }
}
