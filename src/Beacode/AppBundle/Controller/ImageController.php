<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 20.11.2016
 * Time: 16:51
 */

namespace Beacode\AppBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ImageController extends CoreController {

    /**
     * ### Response ###
     *
     * {"result":1,"data":{"id":9}}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Upload new profile image for logged in user.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveLoggedInUserImageAction(Request $request) {
        $params = $this->getParams();
        $files = $this->getPostFiles($request);

        $data = ['objectId'=>$params['loggedInUserId']];
        $systemData = ['projectRoot'=>$params['projectRoot']];
        $retval = $this->getRepo('Image')->saveAppLoggedInUserImage($data, $files['image'], $systemData);

        return $this->getSerializedResponse($retval);
    }
}
