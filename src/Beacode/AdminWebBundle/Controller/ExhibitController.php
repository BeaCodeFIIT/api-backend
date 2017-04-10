<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 16.11.2016
 * Time: 12:24
 */

namespace Beacode\AdminWebBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class ExhibitController extends CoreController {

    /**
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Show all exhibits which belongs to given event. Sorted by name ASC.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showEventsExhibitsAction($eventId) {
        $data = ['eventId'=>$eventId];
        $retval = $this->getRepo('Exhibit')->showAdminWebEventsExhibits($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Request ###
     *
     * {"name":"volvo","description":"pekne cierne auto","start":"2016-10-05 18:00","end":"2016-10-08 18:00"}
     *
     * "start", "end" can be empty
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
     *     section="Admin Web",
     *     description="Save new exhibit for given event.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveEventsExhibitAction(Request $request, $eventId) {
        $data = $this->getPostData($request);

        $data['eventId'] = $eventId;
        $retval = $this->getRepo('Exhibit')->saveAdminWebEventsExhibit($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $eventId
     * @param $exhibitId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Delete given exhibit.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"},
     *         {"name"="exhibitId", "dataType"="integer", "description"="id of exhibit"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function deleteEventsExhibitAction($eventId, $exhibitId) {
        $data = ['eventId'=>$eventId, 'id'=>$exhibitId];
        $retval = $this->getRepo('Exhibit')->deleteAdminWebEventsExhibit($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Request ###
     *
     * [{"op":"replace","path":"/description","value":"some desc"}]
     *
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $eventId
     * @param $exhibitId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Change given exhibit.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"},
     *         {"name"="exhibitId", "dataType"="integer", "description"="id of exhibit"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function changeEventsExhibitAction(Request $request, $eventId, $exhibitId) {
        $patchArray = $this->getPostData($request);

        $data = ['eventId'=>$eventId, 'id'=>$exhibitId];
        $retval = $this->getRepo('Exhibit')->changeAdminWebEventsExhibit($data, $patchArray);

        return $this->getSerializedResponse($retval);
    }
}
