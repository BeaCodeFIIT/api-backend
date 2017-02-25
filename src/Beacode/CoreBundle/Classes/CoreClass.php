<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 16.11.2016
 * Time: 20:54
 */

namespace Beacode\CoreBundle\Classes;


class CoreClass {

    protected $em;

    /**
     * CoreClass constructor.
     * @param $params
     */
    public function __construct($params) {
        $this->em = $params['em'];
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $entity
     * @return mixed
     */
    public function getRepo($entity) {
        $bundle = 'BeacodeCoreBundle:';
        if ($entity == 'User') $bundle = 'BeacodeUserBundle:';
        return $this->em->getRepository($bundle.$entity);
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $retval
     * @return bool
     */
    public function isError($retval) {
        if ((is_int($retval)) && ($retval <= 0)) return true;
        return false;
    }
}
