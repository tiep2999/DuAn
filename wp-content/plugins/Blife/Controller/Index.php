<?php

include_once(ABSPATH . '/wp-content/plugins/Blife/Constants.php');
include_once(Constants::BLIFE_PLUGIN . '/Model/Machine.php');

class Index
{
    public function execute()
    {
        if (isset($_GET['machine'])) {
            $machine = new Machine();
            $fromDate = $_POST['from'] ?? '';
            $toDate = $_POST['to'] ?? '';
            $machineData = $machine->getMachineData($_GET['machine'], $fromDate, $toDate);
            include_once(Constants::BLIFE_PLUGIN . '/views/templates/statistical.phtml');
        } else {
            $machine = new Machine();
            $listMachine = $machine->getList();
            include_once(Constants::BLIFE_PLUGIN . '/views/templates/list_machine.phtml');
        }
    }
}