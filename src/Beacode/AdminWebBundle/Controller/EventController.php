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
     * {}
     *
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
    public function showLiuEventsAction() {
        $data = ['creatorId'=>5];
        $retval = $this->getRepo('Event')->showLiuEvents($data);
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
     *     section="Admin Web",
     *     description="Create new event.",
     *     parameters={
     *         {"name"="name", "dataType"="string", "required"=true, "description"="name of event"},
     *         {"name"="start", "dataType"="string", "required"=true, "format"="Y-m-d H:i:s", "description"="start of event"},
     *         {"name"="end", "dataType"="string", "required"=true, "format"="Y-m-d H:i:s", "description"="end of event"},
     *         {"name"="location", "dataType"="string", "required"=true, "description"="location of event"},
     *         {"name"="description", "dataType"="string", "required"=true, "description"="description of event"},
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveLiuEventAction(Request $request) {
        $data = $this->getPostData($request);
        $data['creatorId'] = 5;
        $retval = $this->getRepo('Event')->saveLiuEvent($data);
        return $this->getSerializedResponse($retval);
    }
}
