<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 1.12.2016
 * Time: 14:21
 */

namespace Beacode\CoreBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class CoreCommand extends ContainerAwareCommand {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     */
    protected function configure() {
        $this->setName('XXX-XXX-XXX-XXX');
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return array
     */
    protected function getParams() {
        $params = [];
        $params['em'] = $this->getContainer()->get('doctrine')->getEntityManager();
        return $params;
    }
}
