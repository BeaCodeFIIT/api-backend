<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 25.3.2017
 * Time: 16:16
 */

namespace Beacode\CoreBundle\Classes;


class BeaconSvgParser extends BeaconParser {

    protected function parse($data) {
        $svg = new \SimpleXMLElement($data['pathToData'], 0, true);

        $beacons = $svg->xpath('//*[contains(@id, "circle")]');
        $beaconDatas = [];
        foreach ($beacons as $beacon) {
            $beaconData = [];
            $beaconData['minor'] = $beacon['minor']->__toString();
            $beaconData['coorX'] = $beacon['cx']->__toString();
            $beaconData['coorY'] = $beacon['cy']->__toString();

            $beaconData['eventId'] = $data['eventId'];

            $beaconDatas[] = $beaconData;
        }

        return $beaconDatas;
    }

    public function processEvent($data) {
        //todo fill pathToData
        $this->process($data);

        return ['result'=>1];
    }
}
