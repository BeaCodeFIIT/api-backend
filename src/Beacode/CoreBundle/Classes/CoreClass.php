<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 16.11.2016
 * Time: 20:54
 */

namespace Beacode\CoreBundle\Classes;


use Doctrine\ORM\EntityManager;

class CoreClass {

    protected $em;

    public function __construct($params) {
        $this->em = $params['em'];
    }

    public function getRepo($entity) {
        $bundle = 'BeacodeCoreBundle:';
        if ($entity == 'User') $bundle = 'BeacodeUserBundle:';
        return $this->em->getRepository($bundle.$entity);
    }
}
