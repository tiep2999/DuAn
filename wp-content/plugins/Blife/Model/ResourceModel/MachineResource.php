<?php

class MachineResource
{
    protected $name;
    protected $data;

    public function __construct($name = '', $data = [])
    {
        $this->name = $name;
        $this->data = $data;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getLastTimeUsage($date = '')
    {
        if (empty($this->data)) {
            return '';
        }

        if (empty($date)) {
            $listDate = array_keys($this->data);
            rsort($listDate);
            $date = $listDate[0];
        }

        return ($this->data[$date] && isset(end($this->data[$date])['time'])) ?
            $date . ' ' . end($this->data[$date])['time'] : '';
    }
}