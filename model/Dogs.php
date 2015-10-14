<?php
namespace model;
require_once("Dog.php");
require_once("DogDAL.php");

//Gather all dogs from the database in a list
class Dogs{
    private $dogDAL;
    private $listOfDogs = array();

    public function __construct(dogDAL $dogDAL){
        $this->dogDAL = $dogDAL;
        $listOfID = $dogDAL->getAllDogs();
        foreach($listOfID as $id){
            $newDog = $this->dogDAL->getSingleDog($id);
            $this->listOfDogs[] = $newDog;
        }
        foreach($this->listOfDogs as $dog){
            $this->dogDAL->addNewPhotos($dog);
        }
    }
    public function _test(){
        foreach($this->listOfDogs as $dog){
            $dog->_test();
        }
    }
    public function getDogs(){
        return $this->listOfDogs;
    }
    public function getDogsPageWise($startNumber, $numberOfDogs){
        $limitedListOfDogs = array();
        if(sizeof($this->listOfDogs) < $startNumber + $numberOfDogs){
            $endNumber = sizeof($this->listOfDogs);
        }
        else{
            $endNumber = $startNumber + $numberOfDogs;
        }
        for($i=$startNumber; $i<$endNumber;$i++){
            $limitedListOfDogs[]= $this->listOfDogs[$i];
        }
        return $limitedListOfDogs;
    }
}