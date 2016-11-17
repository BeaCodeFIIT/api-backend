<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 16.11.2016
 * Time: 12:13
 */

namespace Beacode\AppBundle\Controller;


use Beacode\CoreBundle\Controller\CoreController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class StarredEventController extends CoreController {

    /**
     * ### Response ###
     *
     * {"result":1,"data":[{"id":3,"event":{"id":3,"name":"dinosauri","start":"27.11.2016 00:00:00","end":"30.11.2016 00:00:00","description":"praveke tvory","location":{"id":1,"name":"ba","latitude":48.25,"longitude":17.48}}},{"id":1,"event":{"id":1,"name":"auto salon","start":"06.11.2016 00:00:00","end":"09.11.2016 00:00:00","description":"vystava drahych aut","location":{"id":1,"name":"ba","latitude":48.25,"longitude":17.48},"images":[{"id":2,"description":"udalost picture","pathWithFile":"/files/images/event/1/a2.png"},{"id":5,"description":"obrazok","pathWithFile":"/files/images/event/1/a5.png"}]}}]}
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
        $params = $this->getParams();

        $data = ['userId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('StarredEvent')->showAppStarredEvents($data);

        return $this->getSerializedResponse($retval);
    }
}
