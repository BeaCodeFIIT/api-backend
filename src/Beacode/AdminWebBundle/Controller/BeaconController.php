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
use Symfony\Component\HttpFoundation\Request;

class BeaconController extends CoreController {

    /**
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Show beacons which are not linked to any exhibit.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showBeaconsAction() {
        $retval = $this->getRepo('Beacon')->showAdminWebBeacons();

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Request ###
     *
     * [{"op":"replace","path":"/exhibitId","value":1}]
     *
     * ### Response ###
     *
     * Try!
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @param $beaconId
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Change beacon.",
     *     requirements={
     *         {"name"="beaconId", "dataType"="integer", "description"="id of beacon"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function changeBeaconAction(Request $request, $beaconId) {
        $patchArray = $this->getPostData($request);

        $data = ['id'=>$beaconId];
        $retval = $this->getRepo('Beacon')->changeAdminWebBeacon($data, $patchArray);

        return $this->getSerializedResponse($retval);
    }
}
