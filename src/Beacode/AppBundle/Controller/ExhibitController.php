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
     *     section="App",
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
        $retval = $this->getRepo('Exhibit')->showAppEventsExhibits($data);

        return $this->getSerializedResponse($retval);
    }
}
