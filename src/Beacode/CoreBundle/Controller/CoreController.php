<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 31.10.2016
 * Time: 23:32
 */

namespace Beacode\CoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CoreController extends Controller {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Response
     */
    protected function getSerializedResponse($data) {
        return new Response(json_encode($data));
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $entity
     * @return mixed
     */
    protected function getRepo($entity) {
        return $this->getDoctrine()->getManager()->getRepository('BeacodeCoreBundle:'.$entity);
    }
}
