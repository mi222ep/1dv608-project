<?php
namespace model;
require_once("Dog.php");
require_once("DogDAL.php");

//Gather all dogs from the database in a list
class Dogs{
    private $dogDAL;
    //All dogs in the database
    private $listOfDogs = array();
    //The dogs the user wants to display sorted as the user wants to sort
    private $currentDogs = array();

    public function __construct(\mysqli $mysqli){
        $this->dogDAL = new DogDAL($mysqli);
        $listOfID = $this->dogDAL->getAllDogs();
        foreach($listOfID as $id){
            $newDog = $this->dogDAL->getSingleDog($id);
            $this->listOfDogs[] = $newDog;
        }
        foreach($this->listOfDogs as $dog){
            $this->dogDAL->addNewPhotos($dog);
        }
        //usort($this->listOfDogs, array($this, 'sortByName'));
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
    public function sortByName($a, $b)
    {
        return strcmp($a->getName(), $b->getName());
    }
    public function sortByColor($a, $b){
        return strcmp($a->getColor(), $b->getColor());
    }
    public function sortDogs(){
        usort($this->listOfDogs, array($this, 'sortByColor'));
    }
}