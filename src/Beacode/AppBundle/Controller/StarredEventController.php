<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 16.11.2016
 * Time: 12:13
 */

namespace Beacode\AppBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;

class StarredEventController extends CoreController {

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
    public function showLiuStarredEventsAction() {
        $data = ['userId'=>5];
        $retval = $this->getRepo('StarredEvent')->showLiuStarredEvents($data);
        return $this->getSerializedResponse($retval);
    }
}