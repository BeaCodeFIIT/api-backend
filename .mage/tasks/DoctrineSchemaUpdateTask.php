<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 19.10.2016
 * Time: 16:55
 */

namespace Task;

use Mage\Task\AbstractTask;

class DoctrineSchemaUpdateTask extends AbstractTask {

    public function getName() {
        return 'Performing doctrine:schema:update';
    }

    public function run() {
        $this->runCommandRemote('bin/console doctrine:schema:update --force');

        return true;
    }
}
