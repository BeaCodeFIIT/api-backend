<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 31.3.2017
 * Time: 22:25
 */

namespace Beacode\CoreBundle\Command;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BeaconCalcCommand extends CoreCommand {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     */
    protected function configure() {
        $this->setName('beacon-calc:process');
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $beacons = [
            71=>['shiftX'=>-119, 'shiftY'=>0, 'from'=>'1Down'],
            72=>['shiftX'=>-598, 'shiftY'=>0, 'from'=>'1Top'],
            73=>['shiftX'=>-1083, 'shiftY'=>0, 'from'=>'1Down'],
            74=>['shiftX'=>-1559, 'shiftY'=>0, 'from'=>'1Top'],
            75=>['shiftX'=>-2039, 'shiftY'=>0, 'from'=>'1Down'],

            76=>['shiftX'=>892, 'shiftY'=>0, 'from'=>'2Top'],
            77=>['shiftX'=>366, 'shiftY'=>0, 'from'=>'2Down'],
            78=>['shiftX'=>51, 'shiftY'=>0, 'from'=>'2Top'],

            79=>['shiftX'=>74, 'shiftY'=>0, 'from'=>'3Top'],
            80=>['shiftX'=>73, 'shiftY'=>0, 'from'=>'3Down'],
            81=>['shiftX'=>792, 'shiftY'=>0, 'from'=>'3Middle'],
            82=>['shiftX'=>1453, 'shiftY'=>0, 'from'=>'3Top'],
            83=>['shiftX'=>1453, 'shiftY'=>0, 'from'=>'3Down'],
            84=>['shiftX'=>2114, 'shiftY'=>0, 'from'=>'3Middle'],
            85=>['shiftX'=>2773, 'shiftY'=>0, 'from'=>'3Top'],
            86=>['shiftX'=>2768, 'shiftY'=>0, 'from'=>'3Down'],
            87=>['shiftX'=>3433, 'shiftY'=>0, 'from'=>'3Middle'],

            88=>['shiftX'=>-86, 'shiftY'=>0, 'from'=>'4Top'],
            89=>['shiftX'=>-38, 'shiftY'=>0, 'from'=>'4Down'],
        ];

        $walls = [
            '1Down'=>['x'=>4147, 'y'=>464],
            '1Top'=>['x'=>4148, 'y'=>641],

            '2Down'=>['x'=>1156, 'y'=>467],
            '2Top'=>['x'=>1156, 'y'=>638],

            '3Down'=>['x'=>5997, 'y'=>464],
            '3Middle'=>['x'=>5997, 'y'=>552],
            '3Top'=>['x'=>5997, 'y'=>640],

            '4Down'=>['x'=>9987, 'y'=>465],
            '4Top'=>['x'=>10036, 'y'=>639],
        ];

        $radius = 3;

        foreach ($beacons as $minor=>$beacon) {
            $x = $beacon['shiftX'] + $walls[$beacon['from']]['x'];
//            $x -= $radius;
            $y = $beacon['shiftY'] + $walls[$beacon['from']]['y'];
//            if (strpos($beacon['from'], 'Middle') !== false) $y -= $radius;
//            if (strpos($beacon['from'], 'Top') !== false) $y -= 2*$radius;

            echo 'minor: '.$minor.' X: '.$x.' Y: '.$y."\n";
        }

        $output->writeln('DONE');
    }
}
