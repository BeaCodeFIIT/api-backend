<?php

namespace Beacode\CoreBundle\Repository;
use Beacode\CoreBundle\Entity\Location;

/**
 * LocationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LocationRepository extends CoreRepository {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Location|int|null|object
     */
    public function createLocation($data) {
        $object = new Location();
        $data['systemCreated'] = new \DateTime();
        $object = $this->getLocationObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Location|int|null|object
     */
    public function createIfNotExistLocation($data) {
        $object = $this->getLocation($data);
        if (empty($object)) {
            $object = $this->createLocation($data);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Location|null $object
     * @return Location|int|null|object
     */
    public function editLocation($data, Location $object=null) {
        if (empty($object)) {
            $object = $this->getLocation($data);
            if (is_int($object)) return $object;
        }

        $object = $this->getLocationObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Location|int|null|object
     */
    public function upsertLocation($data) {
        $object = $this->getLocation($data);
        if (empty($object)) {
            $object = $this->createLocation($data);
        } else {
            $object = $this->editLocation($data, $object);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Location|null $object
     * @return int
     */
    public function removeLocation($data, Location $object=null) {
        if (empty($object)) {
            $object = $this->getLocation($data);
            if (is_int($object)) return $object;
        }

        $this->_em->remove($object);

        $this->_em->flush();

        return 1;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return int|null|object
     */
    public function getLocation($data) {
        if (!empty($data['id'])) {
            $object = $this->findOneBy(['id'=>$data['id']]);
        }

        if (empty($object)) return 0;
        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Location $object
     * @param $data
     * @return Location
     */
    private function getLocationObjectFromData(Location $object, $data) {
        if (!empty($data['name'])) $object->setName($data['name']);
        if (!empty($data['latitude'])) $object->setLatitude($data['latitude']);
        if (!empty($data['longitude'])) $object->setLongitude($data['longitude']);
        if (!empty($data['systemCreated'])) $object->setSystemCreated($data['systemCreated']);

        $this->_em->persist($object);

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Location $object
     * @param $forFunction
     * @param array $dataIn
     * @return array|int
     */
    public function getLocationDataFromObject(Location $object=null, $forFunction, $dataIn=[]) {
        if (empty($object)) {
            $object = $this->getLocation($dataIn);
            if (is_int($object)) return $object;
        }

        $whichData = [];
        if ($forFunction == 1) $whichData = [1, 2, 3];

        $data = [];
        if (in_array(1, $whichData)) {
            $data['id'] = $object->getId();
        }
        if (in_array(2, $whichData)) {
            $data['name'] = $object->getName();
        }
        if (in_array(3, $whichData)) {
            $data['latitude'] = $object->getLatitude();
            $data['longitude'] = $object->getLongitude();
        }

        return $data;
    }

    //******************************************************************************************************************
    //******************************************************************************************************************

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return array
     */
    public function showAdminWebLocations($data) {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i');
        $qb->from('BeacodeCoreBundle:Location', 'i');
        if (!empty($data['namePart'])) {
            $qb->where('i.name LIKE ?1');
            $qb->setParameter(1, $data['namePart'] . '%');
        }
        $qb->orderBy('i.name', 'ASC');
        $locationObjectArray = $qb->getQuery()->getResult();

        $locationDataArray = [];
        foreach ($locationObjectArray as $locationObject) {
            $locationDataArray[] = $this->getLocationDataFromObject($locationObject, 1);
        }

        return ['result'=>1, 'data'=>$locationDataArray];
    }
}
