<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 2.11.2016
 * Time: 21:50
 */

namespace Beacode\AdminWebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CoreController extends \Beacode\CoreBundle\Controller\CoreController {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
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
    public function showCreatedEventsAction() {
        $data = ['creatorId'=>5];
        $retval = $this->getRepo('Event')->showCreatedEvents($data);
        return $this->getSerializedResponse($retval);
    }

    /**
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
    public function showExhibitsAction($eventId) {
        $data = ['eventId'=>$eventId];
        $retval = $this->getRepo('Exhibit')->showExhibits($data);
        return $this->getSerializedResponse($retval);
    }
}
