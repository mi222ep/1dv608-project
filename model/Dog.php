<?php
namespace model;
require_once("model/DogDAL.php");
class Dog{
    private $dogID;
    private $name;
    private $regnr;
    private $sex;
    private $color;
    private $sire;
    private $dam;
    private $dayOfBirth;
    private $database;

    public function __construct(DogDAL $database, $dogID){
        $this->database = $database;
        $this->dogID = $dogID;
        $this->name =$database->getDogNameFromDB($this->dogID);
        $this->regnr=$database->getRegnrFromDB($this->dogID);
        $this->sex="male";
        $this->color=$database->getColorFromDB($this->dogID);
        $this->sire="Johan";
        $this->dam="Lisa";
        $this->dayOfBirth="2015-02-03";
    }
    public function _test(){
        echo "<br>" . $this->dogID, $this->name, $this->regnr, $this->sex, $this->color, $this->sire, $this->dam, $this->dayOfBirth;
    }
}