<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 17.11.2016
 * Time: 12:45
 */

namespace Beacode\AdminWebBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class LocationController extends CoreController {

    /**
     * ### Request ###
     * can be empty
     *
     * {"namePart":"b"}
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
     *     description="Show all existing locations which start with given text. Sorted by name ASC.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showLocationsAction(Request $request) {
        $data = $this->getPostData($request);

        $retval = $this->getRepo('Location')->showAdminWebLocations($data);

        return $this->getSerializedResponse($retval);
    }
}
