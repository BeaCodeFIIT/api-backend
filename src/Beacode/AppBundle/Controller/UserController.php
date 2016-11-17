<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 16.11.2016
 * Time: 12:14
 */

namespace Beacode\AppBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class UserController extends CoreController {

    /**
     * ### Response ###
     *
     * {"result":1,"data":{"id":5,"firstName":"Ferko","lastName":"Babrak","image":{"id":1,"description":"profile picture","pathWithFile":"/files/images/user/5/a1.png"}}}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show logged in user.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showLoggedInUserAction() {
        $params = $this->getParams();

        $data = ['id'=>$params['loggedInUserId']];
        $retval = $this->getRepo('User')->showAppLoggedInUser($data);

        return $this->getSerializedResponse($retval);
    }
}
