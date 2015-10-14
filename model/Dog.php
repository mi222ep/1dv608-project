<?php
namespace model;
class Dog{
    private $dogID;
    private $name;
    private $regnr;
    private $sex;
    private $color;
    private $sire;
    private $dam;
    private $dayOfBirth;

    public function __construct($dogID, $name, $regnr, $sex, $color, $sire, $dam, $dayOfBirth){
        $this->dogID = $dogID;
        $this->name =$name;
        $this->regnr=$regnr;
        $this->sex=$sex;
        $this->color=$color;
        $this->sire=$sire;
        $this->dam=$dam;
        $this->dayOfBirth=$dayOfBirth;
    }
    public function _test(){
        echo "<br>" . $this->dogID, $this->name, $this->regnr, $this->sex, $this->color, $this->sire, $this->dam, $this->dayOfBirth;
    }
}