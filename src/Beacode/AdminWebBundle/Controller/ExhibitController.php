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
     * {"result":1,"data":[{"id":3,"name":"BMW","description":"velmi drahe auto","beacons":[{"id":3,"UUID":"BB5FC2CD-048E-315C-2D8B-205E7B523476","major":2,"minor":0}]},{"id":1,"name":"ford siesta","description":"pekne auto","images":[{"id":4,"description":"exponat picture","pathWithFile":"/files/images/exhibit/1/a4.png"}],"beacons":[{"id":1,"UUID":"DEADBEEF-CA1F-BABE-FEED-FEEDC0DEFACE","major":20,"minor":10},{"id":2,"UUID":"BB5FC2CD-048E-315C-2D8B-205E7B523476","major":1,"minor":0}]},{"id":2,"name":"kia nokia","description":"toto nie je telefon"}]}
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
     * {"name":"volvo","description":"pekne cierne auto"}
     *
     * ### Response ###
     *
     * {"result":1,"data":{"id":4}}
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
}
