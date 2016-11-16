<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 16.11.2016
 * Time: 12:12
 */

namespace Beacode\AppBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;

class EventController extends CoreController {

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
}