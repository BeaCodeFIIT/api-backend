<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 31.10.2016
 * Time: 23:12
 */

namespace Beacode\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class CoreController extends \Beacode\CoreBundle\Controller\CoreController {

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
     *     description="Show all existing events which start with given text. Sorted by name ASC.",
     *     parameters={
     *         {"name"="namePart", "dataType"="string", "required"=false, "description"="start of name of event"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showEventsAction(Request $request) {
        $data = $this->getPostData($request);
        $retval = $this->getRepo('Event')->showEvents($data);
        return $this->getSerializedResponse($retval);
    }

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
     *     description="Show events which were starred by logged in user. Sorted by systemCreated DESC.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showStarredEventsAction() {
        $data = ['userId'=>5];
        $retval = $this->getRepo('StarredEvent')->showStarredEvents($data);
        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Response ###
     *
     * {}
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
    public function showExhibitsAction($eventId) {
        $data = ['eventId'=>$eventId];
        $retval = $this->getRepo('Exhibit')->showExhibits($data);
        return $this->getSerializedResponse($retval);
    }

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
     *     description="Show all interests which belongs to logged in user. Sorted by systemCreated DESC.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showInterestsAction() {
        $data = ['userId'=>5];
        $retval = $this->getRepo('Interest')->showInterests($data);
        return $this->getSerializedResponse($retval);
    }

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
     *     description="Show logged in user.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showLoggedInUserAction() {
        $data = ['id'=>5];
        $retval = $this->getRepo('User')->showLoggedInUser($data);
        return $this->getSerializedResponse($retval);
    }
}
