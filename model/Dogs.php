<?php
namespace model;
require_once("Dog.php");
require_once("DogDAL.php");
class Dogs{
    private $dogDAL;
    private $listOfDogs = array();

    public function __construct(dogDAL $dogDAL){
        $this->dogDAL = $dogDAL;
        $listOfID = $dogDAL->getAllDogs();
        foreach($listOfID as $id){
            $newDog = new Dog($this->dogDAL, $id);
            $this->listOfDogs[] = $newDog;
        }
    }
    public function _test(){
        foreach($this->listOfDogs as $dog){
            $dog->_test();
        }
    }
}