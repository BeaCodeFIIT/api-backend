<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 16.11.2016
 * Time: 14:51
 */

namespace Beacode\AppBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class SelectedExhibitForTourController extends CoreController {

    /**
     * ### Response ###
     *
     * {}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show selected exhibits for tour which belongs to logged in user. Sorted by systemCreated DESC.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showSelectedExhibitsForTour() {
        $params = $this->getParams();

        $data = ['userId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('SelectedExhibitForTour')->showAppSelectedExhibitsForTour($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Request ###
     *
     * {}
     *
     * ### Response ###
     *
     * {}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Save new selected exhibit for tour for logged in user.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveSelectedExhibitForTour(Request $request) {
        $params = $this->getParams();
        $data = $this->getPostData($request);

        $data['userId'] = $params['loggedInUserId'];
        $retval = $this->getRepo('SelectedExhibitForTour')->saveAppSelectedExhibitForTour($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Response ###
     *
     * {}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $selectedExhibitForTourId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Delete selected exhibit for tour which belongs to logged in user.",
     *     requirements={
     *         {"name"="selectedExhibitForTourId", "dataType"="integer", "description"="id of selected exhibit for tour"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function deleteSelectedExhibitForTour($selectedExhibitForTourId) {
        $params = $this->getParams();

        $data = ['id'=>$selectedExhibitForTourId, 'userId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('SelectedExhibitForTour')->deleteAppSelectedExhibitForTour($data);

        return $this->getSerializedResponse($retval);
    }
}
