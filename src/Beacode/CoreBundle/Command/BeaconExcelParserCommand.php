<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 1.12.2016
 * Time: 13:28
 */

namespace Beacode\CoreBundle\Command;


use Beacode\CoreBundle\Classes\BeaconExcelParser;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BeaconExcelParserCommand extends CoreCommand {

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     */
    protected function configure() {
        $this->setName('beacon-excel-parser:process');
    }

    /**
     * @author Juraj Flamik <juraj.flamik@gmail.com>
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $params = $this->getParams();

        $beaconExcelParserClass = new BeaconExcelParser($params);
        $beaconExcelParserClass->process();

        $output->writeln('DONE');
    }
}
