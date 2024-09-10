<?php

class Mobil
{
    public $merek; //apanya
    public $model; 

    public function __construct($merek,$model)
    {
        $this->merek = $merek;
        $this->model = $model;
    }
    public function getMerek ($merek){
        return $this->merek;
     }
}

$mobilsaya = new Mobil('','');