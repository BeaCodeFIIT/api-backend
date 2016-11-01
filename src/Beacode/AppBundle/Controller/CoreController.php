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
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $namePart
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show all existing events which start with given text",
     *     requirements={
     *         {
     *             "name"="namePart",
     *             "dataType"="string",
     *             "requirement"="",
     *             "description"="start of name of event"
     *         }
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showEventsAction($namePart) {
        $data = ['namePart'=>$namePart];
        $retval = $this->getRepo('Event')->showEvents($data);
        return $this->getSerializedResponse($retval);
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show events which starred logged in user",
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
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show all exhibits which belongs to given event",
     *     requirements={
     *          {
     *              "name"="eventId",
     *              "dataType"="integer",
     *              "requirement"="",
     *              "description"="id of event"
     *          }
     *      },
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
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show all interests which belongs to logged in user",
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
}
