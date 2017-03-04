<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 25.2.2017
 * Time: 14:54
 */

namespace Beacode\AdminWebBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

class ImageController extends CoreController {

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
     *     description="Upload new image for event.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveEventImageAction(Request $request, $eventId) {
        $params = $this->getParams($request);
        $files = $this->getPostFiles($request);

        $data = ['objectId'=>$eventId];
        $systemData = ['projectRoot'=>$params['projectRoot']];
        $retval = $this->getRepo('Image')->saveAdminWebEventImage($data, $files['image'], $systemData);

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
     * @param $exhibitId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Upload new image for exhibit.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"},
     *         {"name"="exhibitId", "dataType"="integer", "description"="id of exhibit"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveEventsExhibitImageAction(Request $request, $eventId, $exhibitId) {
        $params = $this->getParams($request);
        $files = $this->getPostFiles($request);

        $data = ['objectId'=>$exhibitId];
        $systemData = ['projectRoot'=>$params['projectRoot']];
        $retval = $this->getRepo('Image')->saveAdminWebEventsExhibitImage($data, $files['image'], $systemData);

        return $this->getSerializedResponse($retval);
    }
}
