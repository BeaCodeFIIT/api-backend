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
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class EventController extends CoreController {

    /**
     * ### Request ###
     * can be empty
     *
     * {"namePart":"a"}
     *
     * ### Response ###
     *
     * {"result":1,"data":[{"id":1,"name":"auto salon","start":"06.11.2016 00:00:00","end":"09.11.2016 00:00:00","description":"vystava drahych aut","location":{"id":1,"name":"ba","latitude":48.25,"longitude":17.48},"images":[{"id":2,"description":"udalost picture","pathWithFile":"/files/images/event/1/a2.png"},{"id":5,"description":"obrazok","pathWithFile":"/files/images/event/1/a5.png"}]},{"id":2,"name":"auto vystava","start":"13.11.2016 00:00:00","end":"15.11.2016 00:00:00","description":"to iste ako auto salon","location":{"id":2,"name":"ke","latitude":48.69,"longitude":21.64972},"images":[{"id":3,"description":"udalost picture 2","pathWithFile":"/files/images/event/2/a3.png"}]}]}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="App",
     *     description="Show all existing events which start with given text. Sorted by name ASC.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showEventsAction(Request $request) {
        $data = $this->getPostData($request);

        $retval = $this->getRepo('Event')->showAppEvents($data);

        return $this->getSerializedResponse($retval);
    }
}
