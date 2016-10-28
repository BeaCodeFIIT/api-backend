<?php

namespace Beacode\CoreBundle\Repository;
use Beacode\CoreBundle\Entity\SelectedExhibitForTour;
use Doctrine\ORM\EntityRepository;

/**
 * SelectedExhibitForTourRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SelectedExhibitForTourRepository extends EntityRepository {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return SelectedExhibitForTour|int|null|object
     */
    public function createSelectedExhibitForTour($data) {
        $object = new SelectedExhibitForTour();
        $data['systemCreated'] = new \DateTime();
        $object = $this->getSelectedExhibitForTourObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return SelectedExhibitForTour|int|null|object
     */
    public function createIfNotExistSelectedExhibitForTour($data) {
        $object = $this->getSelectedExhibitForTour($data);
        if (empty($object)) {
            $object = $this->createSelectedExhibitForTour($data);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param SelectedExhibitForTour|null $object
     * @return SelectedExhibitForTour|int|null|object
     */
    public function editSelectedExhibitForTour($data, SelectedExhibitForTour $object=null) {
        if (empty($object)) {
            $object = $this->getSelectedExhibitForTour($data);
            if (empty($object)) return 0;
        }

        $object = $this->getSelectedExhibitForTourObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return SelectedExhibitForTour|int|null|object
     */
    public function upsertSelectedExhibitForTour($data) {
        $object = $this->getSelectedExhibitForTour($data);
        if (empty($object)) {
            $object = $this->createSelectedExhibitForTour($data);
        } else {
            $object = $this->editSelectedExhibitForTour($data, $object);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param SelectedExhibitForTour|null $object
     * @return int
     */
    public function removeSelectedExhibitForTour($data, SelectedExhibitForTour $object=null) {
        if (empty($object)) {
            $object = $this->getSelectedExhibitForTour($data);
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
    public function getSelectedExhibitForTour($data) {
        $object = null;

        if (!empty($data['id'])) {
            $object = $this->findOneBy(['id'=>$data['id']]);
        } else if ((!empty($data['userId'])) && (!empty($data['exhibitId']))) {
            $object = $this->findOneBy(['userId'=>$data['userId'], 'exhibitId'=>$data['exhibitId']]);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param SelectedExhibitForTour $object
     * @param $data
     * @return SelectedExhibitForTour
     */
    private function getSelectedExhibitForTourObjectFromData(SelectedExhibitForTour $object, $data) {
        if (!empty($data['userId'])) $object->setUserId($data['userId']);
        if (!empty($data['exhibitId'])) $object->setExhibitId($data['exhibitId']);
        if (!empty($data['systemCreated'])) $object->setSystemCreated($data['systemCreated']);

        $this->_em->persist($object);

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param SelectedExhibitForTour $object
     * @param $forFunction
     * @return array
     */
    public function getSelectedExhibitForTourDataFromObject(SelectedExhibitForTour $object, $forFunction) {
        $whichData = [];
        if ($forFunction == 1) $whichData = [1];

        $data = [];
        if (in_array(1, $whichData)) {
            $data['id'] = $object->getId();
        }
        if (in_array(2, $whichData)) {
            $data['userId'] = $object->getUserId();
            $data['exhibitId'] = $object->getExhibitId();
        }

        return $data;
    }
}
