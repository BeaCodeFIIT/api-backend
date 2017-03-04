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
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @param $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show selected exhibits for tour which belongs to logged in user. Sorted by systemCreated DESC.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showEventsSelectedExhibitsForTourAction(Request $request, $eventId) {
        $params = $this->getParams($request);

        $data = ['userId'=>$params['loggedInUserId'], 'eventId'=>$eventId];
        $retval = $this->getRepo('SelectedExhibitForTour')->showAppEventsSelectedExhibitsForTour($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Request ###
     *
     * {"exhibitId":1}
     *
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @param $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Save new selected exhibit for tour for logged in user.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveEventsSelectedExhibitForTourAction(Request $request, $eventId) {
        $params = $this->getParams($request);
        $data = $this->getPostData($request);

        $data['userId'] = $params['loggedInUserId'];
        $data['eventId'] = $eventId;
        $retval = $this->getRepo('SelectedExhibitForTour')->saveAppEventsSelectedExhibitForTour($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @param $eventId
     * @param $selectedExhibitForTourId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Delete selected exhibit for tour which belongs to logged in user.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"},
     *         {"name"="selectedExhibitForTourId", "dataType"="integer", "description"="id of selected exhibit for tour"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function deleteEventsSelectedExhibitForTourAction(Request $request, $eventId, $selectedExhibitForTourId) {
        $params = $this->getParams($request);

        $data = ['id'=>$selectedExhibitForTourId, 'userId'=>$params['loggedInUserId'], 'eventId'=>$eventId];
        $retval = $this->getRepo('SelectedExhibitForTour')->deleteAppEventsSelectedExhibitForTour($data);

        return $this->getSerializedResponse($retval);
    }
}
