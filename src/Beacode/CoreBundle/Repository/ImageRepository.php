<?php

namespace Beacode\CoreBundle\Repository;
use Beacode\CoreBundle\Entity\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * ImageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImageRepository extends CoreRepository {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Image|int|null|object
     */
    public function createImage($data) {
        $object = new Image();
        $data['systemCreated'] = new \DateTime();
        $object = $this->getImageObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Image|int|null|object
     */
    public function createIfNotExistImage($data) {
        $object = $this->getImage($data);
        if (empty($object)) {
            $object = $this->createImage($data);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Image|null $object
     * @return Image|int|null|object
     */
    public function editImage($data, Image $object=null) {
        if (empty($object)) {
            $object = $this->getImage($data);
            if ($this->isError($object)) return $object;
        }

        $object = $this->getImageObjectFromData($object, $data);

        $this->_em->flush();

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Image|int|null|object
     */
    public function upsertImage($data) {
        $object = $this->getImage($data);
        if (empty($object)) {
            $object = $this->createImage($data);
        } else {
            $object = $this->editImage($data, $object);
        }

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param Image|null $object
     * @return int
     */
    public function removeImage($data, Image $object=null) {
        if (empty($object)) {
            $object = $this->getImage($data);
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
    public function getImage($data) {
        if (!empty($data['id'])) {
            $object = $this->findOneBy(['id'=>$data['id']]);
        } else if ((!empty($data['objectId'])) && (!empty($data['objectType'])) && ($data['objectType'] == 'user')) {
            $object = $this->findOneBy(['objectId'=>$data['objectId'], 'objectType'=>$data['objectType']]);
        }

        if (empty($object)) return 0;
        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Image $object
     * @param $data
     * @return Image
     */
    private function getImageObjectFromData(Image $object, $data) {
        if (!empty($data['objectId'])) $object->setObjectId($data['objectId']);
        if (!empty($data['objectType'])) $object->setObjectType($data['objectType']);
        if (!empty($data['hash'])) $object->setHash($data['hash']);
        if (!empty($data['extension'])) $object->setExtension($data['extension']);
        if (!empty($data['description'])) $object->setDescription($data['description']);
        if (!empty($data['systemCreated'])) $object->setSystemCreated($data['systemCreated']);

        $this->_em->persist($object);

        return $object;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Image $object
     * @param $forFunction
     * @param array $dataIn
     * @return array|int
     */
    public function getImageDataFromObject(Image $object=null, $forFunction, $dataIn=[]) {
        if (empty($object)) {
            $object = $this->getImage($dataIn);
            if ($this->isError($object)) return $object;
        }

        $whichData = [];
        if ($forFunction == 1) $whichData = [1, 6, 7];
        else if ($forFunction == 2) $whichData = [1];

        $data = [];
        if (in_array(1, $whichData)) {
            $data['id'] = $object->getId();
        }
        if (in_array(2, $whichData)) {
            $data['objectId'] = $object->getObjectId();
        }
        if (in_array(3, $whichData)) {
            $data['objectType'] = $object->getObjectType();
        }
        if (in_array(4, $whichData)) {
            $data['hash'] = $object->getHash();
        }
        if (in_array(5, $whichData)) {
            $data['extension'] = $object->getExtension();
        }
        if (in_array(6, $whichData)) {
            $data['description'] = $object->getDescription();
        }
        if (in_array(7, $whichData)) {
            $data['pathWithFile'] = '/'.$this->getImagePath($object).$this->getImageFile($object);
        }

        return $data;
    }

    //******************************************************************************************************************

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Image $object
     * @return string
     */
    public function getImagePath(Image $object) {
        return 'files/images/'.$object->getObjectType().'/'.$object->getObjectId().'/';
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Image $object
     * @return string
     */
    public function getImageFile(Image $object) {
        return $object->getHash().'.'.$object->getExtension();
    }

    //******************************************************************************************************************
    //******************************************************************************************************************

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @param UploadedFile $file
     * @param $systemData
     * @return array
     */
    public function saveAppLoggedInUserImage($data, UploadedFile $file, $systemData) {
        $data['objectType'] = 'user';
        $data['hash'] = uniqid();
        $data['extension'] = $file->guessExtension();
        $imageObject = $this->upsertImage($data);

        $file->move($systemData['projectRoot'].$this->getImagePath($imageObject), $this->getImageFile($imageObject));

        $imageData = $this->getImageDataFromObject($imageObject, 2);

        return ['result'=>1, 'data'=>$imageData];
    }
}
