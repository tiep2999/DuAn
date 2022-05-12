<?php

require_once ABSPATH . 'wp-content/plugins/Blife/Helper/Log.php';
include_once('ResourceModel/MachineResource.php');

class Machine
{
    function getList()
    {
        $listMachine = [];
        $data = [];
        $log = new Log();
        $files = $log->getAllFiles();
        foreach ($files as $file) {
            [$name, $date] = explode(" ", $file);
            $dataFile = $log->readFile($file);
            $data[$name][$date] = $dataFile;
            $listMachine[$name] = new MachineResource($name, $data[$name]);
        }
        return $listMachine;
    }

    function getMachineData($name, $fromDate, $toDate)
    {
        $listMachine = $this->getList();
        if (!isset($listMachine[$name])) {
            return [];
        }

        /**
         * @var MachineResource $machine
         */
        $machine = $listMachine[$name];
        $dataMachine = $machine->getData();
        foreach ($dataMachine as $date => $data) {
            if ($fromDate && strtotime($date) < strtotime($fromDate)) {
                unset($dataMachine[$date]);
            }
            if ($toDate && strtotime($date) > strtotime($toDate)) {
                unset($dataMachine[$date]);
            }
        }
        $machine->setData($dataMachine);
        $results = [];
        foreach ($machine->getData() as $date => $dataMachine) {
            $results['time_usage'][$date] = $this->getTimeUsage($dataMachine);
            $functionUsage = $this->getFunctionUsage($dataMachine);
            foreach ($functionUsage as $functionName => $data) {
                if (!isset($results['function_usage'][$functionName])) {
                    $results['function_usage'][$functionName]['count'] = 0;
                    $results['function_usage'][$functionName]['datetime'] = '';
                }
                $results['function_usage'][$functionName]['count'] += $data['count'];
                $results['function_usage'][$functionName]['datetime'] = $date . ' ' . $data['time'];
            }
        }
        $templatesAndTalks = $this->getTemplateAndTalk($machine);
        $results['template'] = $templatesAndTalks['template'];
        $results['talk'] = $templatesAndTalks['talk'];
        return $results;
    }

    function getTimeUsage($dataMachine)
    {
        $result = [];
        foreach ($dataMachine as $time => $data) {
            $hour = (int)date('H', strtotime($time));
            if (!isset($result[$hour])) {
                $result[$hour] = 0;
            }
            $result[$hour] += count($data['data']);
        }
        return $result;
    }

    function getFunctionUsage($dataMachine)
    {
        $results = [];
        foreach ($dataMachine as $data) {
            foreach ($data['data'] as $function) {
                $functionName = $function[0];
                if (!$results[$functionName]['count']) {
                    $results[$functionName]['count'] = 0;
                }
                $results[$functionName]['count']++;
                $results[$functionName]['time'] = $data['time'];
            }
        }
        return $results;
    }

    function getTemplateAndTalk($machine)
    {
        $results = [];
        $count = [];
        foreach ($machine->getData() as $date => $data) {
            foreach ($data as $time => $listAction) {
                foreach ($listAction['data'] as $action) {
                    $last = $date . ' ' . $time;
                    if (count($action) == 3 && $action[0] === 'YesNo') {
                        $template = $action[2];
                        if (!isset($count[$template])) {
                            $count[$template] = 0;
                        }
                        $count[$template]++;
                        $results['template'][$template] = $count[$template] . '|' . $last;
                    }
                    if (count($action) == 3 && $action[0] === 'Typing' && $action[1] == 'Words') {
                        $results['talk'][] = $last . '|Typing|Words|' . $action[2];
                    }
                    if (count($action) == 3 && $action[0] === 'Keyboard' && $action[1] == 'Speak') {
                        $results['talk'][] = $last . '|Keyboard|Speak|' . $action[2];
                    }
                }
            }
        }
        return $results;
    }
}

