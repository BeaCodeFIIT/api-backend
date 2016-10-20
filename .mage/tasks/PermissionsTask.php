<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 19.10.2016
 * Time: 16:45
 */

namespace Task;

use Mage\Task\AbstractTask;

class PermissionsTask extends AbstractTask  {

    public function getName() {
        return 'Changing permissions';
    }

    public function run() {
//        $this->runCommandRemote('sudo chown -R team0616 var/cache/');
//        $this->runCommandRemote('sudo chown -R team0616 var/logs/');
//        $this->runCommandRemote('sudo chown -R team0616 var/sessions/');

//        $this->runCommandRemote('sudo chgrp -R www-data var/cache/');
//        $this->runCommandRemote('sudo chgrp -R www-data var/logs/');
//        $this->runCommandRemote('sudo chgrp -R www-data var/sessions/');

        $this->runCommandRemote('chmod -R 777 var/cache/');
        $this->runCommandRemote('chmod -R 777 var/logs/');
        $this->runCommandRemote('chmod -R 777 var/sessions/');

        return true;
    }
}
