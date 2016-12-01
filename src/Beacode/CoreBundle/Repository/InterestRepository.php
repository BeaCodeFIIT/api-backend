<?php

namespace Beacode\CoreBundle\Repository;
use Beacode\CoreBundle\Entity\Interest;

/**
 * InterestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InterestRepository extends CoreRepository {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Interest|int|null|object
     */
    public function createInterest($data) {
        $object = new Interest();
        $data['systemCreated'] = new \DateTime();
        $object = $this->getInterestObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Interest|int|null|object
     */
    public function createIfNotExistInterest($data) {
        $object = $this->getInterest($data);
        if (empty($object)) {
            $object = $this->createInterest($data);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Interest|null $object
     * @return Interest|int|null|object
     */
    public function editInterest($data, Interest $object=null) {
        if (empty($object)) {
            $object = $this->getInterest($data);
            if ($this->isError($object)) return $object;
        }

        $object = $this->getInterestObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Interest|int|null|object
     */
    public function upsertInterest($data) {
        $object = $this->getInterest($data);
        if (empty($object)) {
            $object = $this->createInterest($data);
        } else {
            $object = $this->editInterest($data, $object);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Interest|null $object
     * @return int
     */
    public function removeInterest($data, Interest $object=null) {
        if (empty($object)) {
            $object = $this->getInterest($data);
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
    public function getInterest($data) {
        if (!empty($data['id'])) {
            $object = $this->findOneBy(['id'=>$data['id']]);
        }

        if (empty($object)) return 0;
        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Interest $object
     * @param $data
     * @return Interest
     */
    private function getInterestObjectFromData(Interest $object, $data) {
        if (!empty($data['userId'])) $object->setUserId($data['userId']);
        if (!empty($data['name'])) $object->setName($data['name']);
        if (!empty($data['systemCreated'])) $object->setSystemCreated($data['systemCreated']);

        $this->_em->persist($object);

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Interest $object
     * @param $forFunction
     * @param array $dataIn
     * @return array|int
     */
    public function getInterestDataFromObject(Interest $object=null, $forFunction, $dataIn=[]) {
        if (empty($object)) {
            $object = $this->getInterest($dataIn);
            if ($this->isError($object)) return $object;
        }

        $whichData = [];
        if ($forFunction == 1) $whichData = [1, 3];
        else if ($forFunction == 2) $whichData = [1];

        $data = [];
        if (in_array(1, $whichData)) {
            $data['id'] = $object->getId();
        }
        if (in_array(2, $whichData)) {
            $data['userId'] = $object->getUserId();
        }
        if (in_array(3, $whichData)) {
            $data['name'] = $object->getName();
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
    public function showAppInterests($data) {
        $interestObjectArray = $this->findBy(['userId'=>$data['userId']], ['systemCreated'=>'DESC']);

        $interestDataArray = [];
        foreach ($interestObjectArray as $interestObject) {
            $interestDataArray[] = $this->getInterestDataFromObject($interestObject, 1);
        }

        return ['result'=>1, 'data'=>$interestDataArray];
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return array
     */
    public function saveAppInterest($data) {
        $interestObject = $this->createInterest($data);

        $interestData = $this->getInterestDataFromObject($interestObject, 2);

        return ['result'=>1, 'data'=>$interestData];
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return array
     */
    public function deleteAppInterest($data) {
        $interestObject = $this->getInterest($data);
        if ($this->isError($interestObject)) return ['result'=>$interestObject];

        $result = $this->removeInterest($data, $interestObject);

        return ['result'=>$result];
    }
}
