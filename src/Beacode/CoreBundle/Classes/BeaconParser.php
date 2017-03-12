<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 12.3.2017
 * Time: 18:18
 */

namespace Beacode\CoreBundle\Classes;


class BeaconParser extends CoreClass {

    public function __construct($params) {
        parent::__construct($params);
    }

    public function process() {
        $beaconDatas = $this->parse();
        $this->saveBeacons($beaconDatas);
    }

    private function parse() {
        $config = '53	46.56	-5
38	41.96	3.3
40	36.11	0
42	33.1	1.86
43	30.12	0
44	27.16	1.86
45	24.12	0
46	21.16	1.86
47	18.16	0
48	15.13	1.86
49	12.16	0
50	9.14	1.86
51	6.12	0
52	3.11	1.86
39	51.16	3.3
54	56.96	0
55	59.96	1.86
56	62.99	0
57	66.05	1.86
58	68.99	0
59	71.96	1.86
60	74.96	0
61	77.96	1.86
62	80.96	0
63	83.96	1.86
64	86.96	0
65	89.96	0
66	89.96	4.24
67	86.96	4.24';

        $config = preg_split('/\s+/', $config);

        $beaconDatas = [];
        $beaconData = [];
        foreach ($config as $key=>$con) {
            if ($key % 3 == 0) {
                $beaconData['minor'] = $con;
            }
            else if ($key % 3 == 1) {
                $beaconData['coorX'] = $con;
            }
            else if ($key % 3 == 2) {
                $beaconData['coorY'] = $con;

                $beaconDatas[] = $beaconData;
                $beaconData = [];
            }
        }

        return $beaconDatas;
    }

    private function saveBeacons($beaconDatas) {
        foreach ($beaconDatas as $key=>$beaconData) {
            $beaconData['UUID'] = 'NONE';
            $beaconData['major'] = 0;

            echo $key.' -> ';
            print_r($beaconData);

            $retval = $this->getRepo('Beacon')->createIfNotExistBeacon($beaconData);
            echo 'RETVAL -> ' . ($this->getRepo('Beacon')->isError($retval) ? $retval : 1) . "\n\n";
        }
    }
}
