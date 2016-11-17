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
     * {"result":1,"data":[{"id":1,"name":"auto salon","start":"06.11.2016 00:00:00","end":"09.11.2016 00:00:00","description":"vystava drahych aut","location":{"id":1,"name":"ba","latitude":48.25,"longitude":17.48},"images":[{"id":2,"description":"udalost picture","pathWithFile":"/files/images/event/1/a2.png"},{"id":5,"description":"obrazok","pathWithFile":"/files/images/event/1/a5.png"}]},{"id":2,"name":"auto vystava","start":"13.11.2016 00:00:00","end":"15.11.2016 00:00:00","description":"to iste ako auto salon","location":{"id":2,"name":"ke","latitude":48.69,"longitude":21.64972},"images":[{"id":3,"description":"udalost picture 2","pathWithFile":"/files/images/event/2/a3.png"}]},{"id":3,"name":"dinosauri","start":"27.11.2016 00:00:00","end":"30.11.2016 00:00:00","description":"praveke tvory","location":{"id":1,"name":"ba","latitude":48.25,"longitude":17.48}}]}
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
    public function showEventsAction() {
        $params = $this->getParams();

        $data = ['creatorId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('Event')->showAdminWebEvents($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Response ###
     *
     * {"result":1,"data":{"id":1,"name":"auto salon","start":"06.11.2016 00:00:00","end":"09.11.2016 00:00:00","description":"vystava drahych aut","location":{"id":1,"name":"ba","latitude":48.25,"longitude":17.48},"images":[{"id":2,"description":"udalost picture","pathWithFile":"/files/images/event/1/a2.png"},{"id":5,"description":"obrazok","pathWithFile":"/files/images/event/1/a5.png"}],"exhibits":{"result":1,"data":[{"id":3,"name":"BMW","description":"velmi drahe auto"},{"id":1,"name":"ford siesta","description":"pekne auto","images":[{"id":4,"description":"exponat picture","pathWithFile":"/files/images/exhibit/1/a4.png"}]},{"id":2,"name":"kia nokia","description":"toto nie je telefon"}]}}}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Show event which belongs to logged in user.",
     *     requirements={
     *         {"name"="eventId", "dataType"="integer", "description"="id of event"}
     *     },
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function showEventAction($eventId) {
        $params = $this->getParams();

        $data =['id'=>$eventId, 'creatorId'=>$params['loggedInUserId']];
        $retval = $this->getRepo('Event')->showAdminWebEvent($data);

        return $this->getSerializedResponse($retval);
    }

    /**
     * ### Request ###
     *
     * {"name":"vystava lodi","start":"2016-10-05 18:00","end":"2016-10-08 18:00","locationId":3,"description":"pekne lode na more"}
     *
     * ### Response ###
     *
     * {"result":1,"data":{"id":4}}
     *
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @ApiDoc(
     *     section="Admin Web",
     *     description="Create new event for logged in user.",
     *     statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     */
    public function saveEventAction(Request $request) {
        $params = $this->getParams();
        $data = $this->getPostData($request);

        $data['creatorId'] = $params['loggedInUserId'];
        $retval = $this->getRepo('Event')->saveAdminWebEvent($data);

        return $this->getSerializedResponse($retval);
    }
}
