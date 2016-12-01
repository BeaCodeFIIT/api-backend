<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 1.12.2016
 * Time: 15:48
 */

namespace Beacode\AdminWebBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class BeaconController extends CoreController {

    /**
     * ### Response ###
     *
     * {"result":1,"data":[{"id":1,"UUID":"DEADBEEF-CA1F-BABE-FEED-FEEDC0DEFACE","major":20,"minor":10},{"id":2,"UUID":"BB5FC2CD-048E-315C-2D8B-205E7B523476","major":1,"minor":0},{"id":3,"UUID":"BB5FC2CD-048E-315C-2D8B-205E7B523476","major":2,"minor":0},{"id":4,"UUID":"E555447F-D91C-4668-A32B-78304DB132D6","major":10,"minor":1}]}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Show beacons.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showBeaconsAction() {
        $retval = $this->getRepo('Beacon')->showBeacons();

        return $this->getSerializedResponse($retval);
    }
}
