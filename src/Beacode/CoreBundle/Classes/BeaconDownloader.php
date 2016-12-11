<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 1.12.2016
 * Time: 11:57
 */

namespace Beacode\CoreBundle\Classes;


class BeaconDownloader extends CoreClass {

    private $authHeader;

    /**
     * BeaconDownloader constructor.
     * @param $params
     */
    public function __construct($params) {
        parent::__construct($params);
        $this->authHeader = 'Authorization: Token token='.$params['gimbal_token'];
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     */
    public function process() {
        $content = $this->getBeaconConfigurations();
        $parsedContent = $this->parseBeaconConfigurations($content);
        $this->saveBeaconConfigurations($parsedContent);
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @return mixed
     */
    private function getBeaconConfigurations() {
        $apiUrl = 'https://manager.gimbal.com/api/beacon_configurations';

        $ch = curl_init();
        $curlOptArray = [
            CURLOPT_URL=>$apiUrl,
            CURLOPT_CUSTOMREQUEST=>'GET',
            CURLOPT_HTTPHEADER=>[$this->authHeader],
            CURLOPT_RETURNTRANSFER=>1
        ];
        curl_setopt_array($ch, $curlOptArray);
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $content
     * @return mixed
     */
    private function parseBeaconConfigurations($content) {
        $parsedContent = json_decode($content, true);

        return $parsedContent;
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param $parsedContent
     */
    private function saveBeaconConfigurations($parsedContent) {
        foreach ($parsedContent as $key=>$beacon) {
            $beaconData = [
                'UUID'=>!empty($beacon['proximity_uuid']) ? $beacon['proximity_uuid'] : null,
                'major'=>isset($beacon['major']) ? $beacon['major'] : null,
                'minor'=>isset($beacon['minor']) ? $beacon['minor'] : null
            ];
            echo $key.' -> ';
            print_r($beaconData);

            $retval = $this->getRepo('Beacon')->createIfNotExistBeacon($beaconData);
            echo 'RETVAL -> ' . ($this->getRepo('Beacon')->isError($retval) ? $retval : 1) . "\n\n";
        }
    }
}
