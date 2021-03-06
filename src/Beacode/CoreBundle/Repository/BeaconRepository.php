<?php

namespace Beacode\CoreBundle\Repository;
use Beacode\CoreBundle\Entity\Beacon;

/**
 * BeaconRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BeaconRepository extends CoreRepository {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Beacon|int|null|object
     */
    public function createBeacon($data) {
        $object = new Beacon();
        $data['systemCreated'] = new \DateTime();
        $object = $this->getBeaconObjectFromData($object, $data);
        if ($this->isError($object)) return $object;

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Beacon|int|null|object
     */
    public function createIfNotExistBeacon($data) {
        $object = $this->getBeacon($data);
        if (empty($object)) {
            $object = $this->createBeacon($data);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Beacon|null $object
     * @return Beacon|int|null|object
     */
    public function editBeacon($data, Beacon $object=null) {
        if (empty($object)) {
            $object = $this->getBeacon($data);
            if ($this->isError($object)) return $object;
        }

        $object = $this->getBeaconObjectFromData($object, $data);
        if ($this->isError($object)) return $object;

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Beacon|int|null|object
     */
    public function upsertBeacon($data) {
        $object = $this->getBeacon($data);
        if (empty($object)) {
            $object = $this->createBeacon($data);
        } else {
            $object = $this->editBeacon($data, $object);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Beacon|null $object
     * @return int
     */
    public function removeBeacon($data, Beacon $object=null) {
        if (empty($object)) {
            $object = $this->getBeacon($data);
            if ($this->isError($object)) return $object;
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
    public function getBeacon($data) {
        if (!empty($data['id'])) {
            $object = $this->findOneBy(['id'=>$data['id']]);
        } else if ((!empty($data['UUID'])) && (isset($data['major'])) && (isset($data['minor']))) {
            $object = $this->findOneBy(['UUID'=>$data['UUID'], 'major'=>$data['major'], 'minor'=>$data['minor']]);
        }

        if (empty($object)) return 0;
        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Beacon $object
     * @param $data
     * @return Beacon|int
     */
    private function getBeaconObjectFromData(Beacon $object, $data) {
        if (array_key_exists('eventId', $data)) $object->setEventId($data['eventId']);
        if (array_key_exists('exhibitId', $data)) $object->setExhibitId($data['exhibitId']);
        if (!empty($data['UUID'])) $object->setUUID($data['UUID']);
        if (isset($data['major'])) $object->setMajor($data['major']);
        if (isset($data['minor'])) $object->setMinor($data['minor']);
        if (!empty($data['systemCreated'])) $object->setSystemCreated($data['systemCreated']);
        if (array_key_exists('coorX', $data)) $object->setCoorX($data['coorX']);
        if (array_key_exists('coorY', $data)) $object->setCoorY($data['coorY']);

        if (!$this->isBeaconObjectConsistent($object)) return -1;

        $this->_em->persist($object);

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Beacon $object
     * @return bool
     */
    private function isBeaconObjectConsistent(Beacon $object) {
        if (empty($object->getUUID())) return false;
        if ($object->getMajor() === null) return false;
        if ($object->getMinor() === null) return false;
        if (empty($object->getSystemCreated())) return false;
        return true;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Beacon $object
     * @param $forFunction
     * @param array $dataIn
     * @return array|int
     */
    public function getBeaconDataFromObject(Beacon $object=null, $forFunction, $dataIn=[]) {
        if (empty($object)) {
            $object = $this->getBeacon($dataIn);
            if ($this->isError($object)) return $object;
        }

        $whichData = [];
        if ($forFunction == 1) $whichData = [1, 2, 3, 4];

        $data = [];
        if (in_array(1, $whichData)) {
            $data['id'] = $object->getId();
        }
        if (in_array(2, $whichData)) {
            $data['UUID'] = $object->getUUID();
            $data['major'] = $object->getMajor();
            $data['minor'] = $object->getMinor();
        }
        if (in_array(3, $whichData)) {
            $data['coorX'] = $object->getCoorX();
            $data['coorY'] = $object->getCoorY();
        }
        if (in_array(4, $whichData)) {
            $data['exhibitId'] = $object->getExhibitId();
        }

        return $data;
    }

    //******************************************************************************************************************
    //******************************************************************************************************************

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return array
     */
    public function showAdminWebBeacons() {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('i');
        $qb->from('BeacodeCoreBundle:Beacon', 'i');
        $qb->where('i.exhibitId IS NULL');
        $beaconObjectArray = $qb->getQuery()->getResult();

        $beaconDataArray = [];
        foreach ($beaconObjectArray as $beaconObject) {
            $beaconDataArray[] = $this->getBeaconDataFromObject($beaconObject, 1);
        }

        return ['result'=>1, 'data'=>$beaconDataArray];
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param $patchArray
     * @return array
     */
    public function changeAdminWebBeacon($data, $patchArray) {
        $beaconObject = $this->getBeacon($data);
        if ($this->isError($beaconObject)) return ['result'=>$beaconObject];

        foreach ($patchArray as $patch) {
            $pathArray = explode('/', $patch['path']);
            if ($patch['op'] == 'replace') {
                $data[$pathArray[1]] = $patch['value'];
            }
        }

        $beaconObject = $this->editBeacon($data, $beaconObject);
        if ($this->isError($beaconObject)) return ['result'=>$beaconObject];

        return ['result'=>1];
    }
}
