<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 31.10.2016
 * Time: 23:32
 */

namespace Beacode\CoreBundle\Controller;


use Beacode\CoreBundle\Classes\CoreClass;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CoreController extends Controller {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return mixed
     */
    protected function getPostData(Request $request) {
        $data1 = $request->request->all();
        $data2 = json_decode($request->getContent(), true);
        $data = array_merge((array)$data1, (array)$data2);
        return $data;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return array
     */
    protected function getGetData(Request $request) {
        $data = $request->query->all();
        return $data;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return array
     */
    protected function getPostFiles(Request $request) {
        $files = $request->files->all();
        return $files;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $data
     * @return Response
     */
    protected function getSerializedResponse($data) {
        $content = json_encode($data);
        $status = 200;
        $headers = ['content-type'=>'application/json'];
        return new Response($content, $status, $headers);
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return array
     */
    protected function getParams(Request $request) {
        $params = [];
        $params['em'] = $this->getDoctrine()->getManager();
        $params['projectRoot'] = $this->getParameter('project_root');

        $userObject = $this->getRepo('User')->createIfNotExistUser(
            ['login'=>uniqid('john'), 'firstName'=>'John', 'lastName'=>'Doe', 'deviceId'=>$request->headers->get('deviceId')]
        );
        $params['loggedInUserId'] = $userObject->getId();

        return $params;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $entity
     * @return mixed
     */
    protected function getRepo($entity) {
        $coreClass = new CoreClass(['em'=>$this->getDoctrine()->getManager()]);
        return $coreClass->getRepo($entity);
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $retval
     * @return bool
     */
    protected function isError($retval) {
        $coreClass = new CoreClass(['em'=>$this->getDoctrine()->getManager()]);
        return $coreClass->isError($retval);
    }
}
