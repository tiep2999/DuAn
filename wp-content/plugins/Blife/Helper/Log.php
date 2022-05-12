<?php

class Log
{
    function getAllFiles()
    {
        return array_diff(scandir('../logs'), ['.', '..']);
    }

    function readFile($fileName)
    {
        $results = [];
        $fh = fopen('../logs/' . $fileName, 'r');
        $preTime = '';
        while ($line = fgets($fh)) {
            [$time, $data] = explode("\t", $line);
            if (!empty($data)) {
                $preTime = $time;
                $results[$preTime] = ['time' => $preTime, 'data' => $data];
            } else {
                $results[$preTime]['data'] = $results[$preTime]['data'] . $time;
            }
        }
        foreach ($results as &$data) {
            $dataFormat = trim(trim($data['data']), "(");
            $dataFormat = trim($dataFormat, ")");
            $dataFormat = explode(")(", $dataFormat);
            $actionArray = [];
            foreach ($dataFormat as $action) {
                $actionArray[] = explode(',', $action, 3);
            }
            $data['data'] = $actionArray;
        }
        fclose($fh);
        return $results;
    }
}