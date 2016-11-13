<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 31.10.2016
 * Time: 23:29
 */

namespace Beacode\CoreBundle\Repository;


use Doctrine\ORM\EntityRepository;

//create, createIfNotExist, edit, upsert, remove, get
//save, change, delete, show

class CoreRepository extends EntityRepository {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $entity
     * @return EntityRepository
     */
    protected function getRepo($entity) {
        return $this->_em->getRepository('BeacodeCoreBundle:'.$entity);
    }
}
