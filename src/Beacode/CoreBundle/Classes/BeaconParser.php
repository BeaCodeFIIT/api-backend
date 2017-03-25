<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 25.3.2017
 * Time: 17:13
 */

namespace Beacode\CoreBundle\Classes;


class BeaconParser extends CoreClass {

    public function process($data=[]) {
        $beaconDatas = $this->parse($data);
        $this->saveBeacons($beaconDatas);
    }

    protected function parse($data) {
        return [];
    }

    protected function saveBeacons($beaconDatas) {
        foreach ($beaconDatas as $key=>$beaconData) {
            $beaconData['UUID'] = 'NONE';
            $beaconData['major'] = 0;

//            echo $key.' -> ';
//            print_r($beaconData);

            $retval = $this->getRepo('Beacon')->createIfNotExistBeacon($beaconData);
//            echo 'RETVAL -> ' . ($this->getRepo('Beacon')->isError($retval) ? $retval : 1) . "\n\n";
        }
    }
}
