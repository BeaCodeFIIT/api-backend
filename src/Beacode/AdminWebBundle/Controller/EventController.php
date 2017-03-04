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

class EventController extends CoreController {

    /**
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Show events which were created by logged in user. Sorted by name ASC.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showEventsAction(Request $request) {
        $params = $this->getParams($request);

        $data = ['creatorId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('Event')->showAdminWebEvents($data);

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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Show event which belongs to logged in user.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showEventAction(Request $request, $eventId) {
        $params = $this->getParams($request);

        $data =['id'=>$eventId, 'creatorId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('Event')->showAdminWebEvent($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Request ###
     *
     * {"name":"vystava lodi","start":"2016-10-05 18:00","end":"2016-10-08 18:00","locationId":3,"description":"pekne lode na more","parentId":0,"level":0}
     *
     * event -> parentId = 0, level = 0<br>
     * event category -> parentId = event id, level = 1
     *
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Save new event for logged in user.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveEventAction(Request $request) {
        $params = $this->getParams($request);
        $data = $this->getPostData($request);

        $data['creatorId'] = $params['loggedInUserId'];
        $retval = $this->getRepo('Event')->saveAdminWebEvent($data);

        return $this->getSerializedResponse($retval);
    }
}
