<?php

namespace Beacode\CoreBundle\Repository;
use Beacode\CoreBundle\Entity\StarredEvent;

/**
 * StarredEventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StarredEventRepository extends CoreRepository {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return StarredEvent|int|null|object
     */
    public function createStarredEvent($data) {
        $object = new StarredEvent();
        $data['systemCreated'] = new \DateTime();
        $object = $this->getStarredEventObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return StarredEvent|int|null|object
     */
    public function createIfNotExistStarredEvent($data) {
        $object = $this->getStarredEvent($data);
        if (empty($object)) {
            $object = $this->createStarredEvent($data);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param StarredEvent|null $object
     * @return StarredEvent|int|null|object
     */
    public function editStarredEvent($data, StarredEvent $object=null) {
        if (empty($object)) {
            $object = $this->getStarredEvent($data);
            if (is_int($object)) return $object;
        }

        $object = $this->getStarredEventObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return StarredEvent|int|null|object
     */
    public function upsertStarredEvent($data) {
        $object = $this->getStarredEvent($data);
        if (empty($object)) {
            $object = $this->createStarredEvent($data);
        } else {
            $object = $this->editStarredEvent($data, $object);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param StarredEvent|null $object
     * @return int
     */
    public function removeStarredEvent($data, StarredEvent $object=null) {
        if (empty($object)) {
            $object = $this->getStarredEvent($data);
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
    public function getStarredEvent($data) {
        if (!empty($data['id'])) {
            $object = $this->findOneBy(['id'=>$data['id']]);
        } else if ((!empty($data['userId'])) && (!empty($data['eventId']))) {
            $object = $this->findOneBy(['userId'=>$data['userId'], 'eventId'=>$data['eventId']]);
        }

        if (empty($object)) return 0;
        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param StarredEvent $object
     * @param $data
     * @return StarredEvent
     */
    private function getStarredEventObjectFromData(StarredEvent $object, $data) {
        if (!empty($data['userId'])) $object->setUserId($data['userId']);
        if (!empty($data['eventId'])) $object->setEventId($data['eventId']);
        if (!empty($data['systemCreated'])) $object->setSystemCreated($data['systemCreated']);

        $this->_em->persist($object);

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param StarredEvent $object
     * @param $forFunction
     * @param array $dataIn
     * @return array|int
     */
    public function getStarredEventDataFromObject(StarredEvent $object=null, $forFunction, $dataIn=[]) {
        if (empty($object)) {
            $object = $this->getStarredEvent($dataIn);
            if (is_int($object)) return $object;
        }

        $whichData = [];
        if ($forFunction == 1) $whichData = [3];

        $data = [];
        if (in_array(1, $whichData)) {
            $data['id'] = $object->getId();
        }
        if (in_array(2, $whichData)) {
            $data['userId'] = $object->getUserId();
        }
        if (in_array(3, $whichData)) {
            $data['eventId'] = $object->getEventId();
        }

        return $data;
    }

    //******************************************************************************************************************

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return mixed
     */
    private function getEventDataFromId($data) {
        $eventData = $this->getRepo('Event')->getEventDataFromObject(null, 1, ['id'=>$data['eventId']]);
        $data['event'] = (!is_int($eventData) ? $eventData : null);
        unset($data['eventId']);

        return $data;
    }

    //******************************************************************************************************************
    //******************************************************************************************************************

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return array
     */
    public function showStarredEvents($data) {
        $starredEventObjectArray = $this->findBy(['userId'=>$data['userId']], ['systemCreated'=>'DESC']);

        $starredEventDataArray = [];
        foreach ($starredEventObjectArray as $key=>$starredEventObject) {
            $starredEventDataArray[$key] = $this->getStarredEventDataFromObject($starredEventObject, 1);
            $starredEventDataArray[$key] = $this->getEventDataFromId($starredEventDataArray[$key]);
        }

        return ['result'=>1, 'data'=>$starredEventDataArray];
    }
}
