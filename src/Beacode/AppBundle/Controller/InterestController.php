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
use Symfony\Component\HttpFoundation\Request;

class InterestController extends CoreController {

    /**
     * ### Response ###
     *
     * {"result":1,"data":[{"id":3,"name":"historia"},{"id":2,"name":"priroda"},{"id":1,"name":"auto"}]}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show all interests which belongs to logged in user. Sorted by systemCreated DESC.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showInterestsAction() {
        $params = $this->getParams();

        $data = ['userId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('Interest')->showAppInterests($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Request ###
     *
     * {"name":"pocitace"}
     *
     * ### Response ###
     *
     * {"result":1,"data":{"id":4}}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Save new interest for logged in user.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveInterestAction(Request $request) {
        $params = $this->getParams();
        $data = $this->getPostData($request);

        $data['userId'] = $params['loggedInUserId'];
        $retval = $this->getRepo('Interest')->saveAppInterest($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Response ###
     *
     * {"result":1}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $interestId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Delete interest which belongs to logged in user.",
     *     requirements={
     *         {"name"="interestId", "dataType"="integer", "description"="id of interest"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function deleteInterestAction($interestId) {
        $params = $this->getParams();

        $data = ['id'=>$interestId, 'userId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('Interest')->deleteAppInterest($data);

        return $this->getSerializedResponse($retval);
    }
}
