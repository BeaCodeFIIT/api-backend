<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 20.10.2016
 * Time: 20:27
 */

namespace Task;


use Mage\Task\AbstractTask;

class CacheClearTask extends AbstractTask  {

    public function getName() {
        return 'Clearing cache';
    }

    public function run() {
        $env = $this->getParameter('env', 'dev');
        $this->runCommandRemote('bin/console cache:clear --env='.$env);

        return true;
    }
}
