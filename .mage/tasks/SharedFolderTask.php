<?php

/**
 * Created by PhpStorm.
 * User: georg
 * Date: 19.10.2016
 * Time: 16:31
 */

namespace Task;

use Mage\Task\AbstractTask;

class SharedFolderTask extends AbstractTask  {

    public function getName() {
        return 'Creating symbolic links to files in shared folder';
    }

    public function run() {
        $sharedFiles = $this->getParameter('sharedFiles', false);

        if ($sharedFiles !== false) {
            $folder = $this->getConfig()->deployment('to');
            foreach (explode(",", $sharedFiles) as $sf) {
                $this->runCommandRemote('ln -s '.$folder.'shared/'.$sf.' '.$sf);
            }
        }

        return true;
    }
}
