<?php
namespace model;
require_once("Dog.php");
require_once("DogDAL.php");

//Gather all dogs from the database in a list
class ListOfDogs{
    private $dogDAL;
    //All dogs in the database
    private $listOfDogs = array();

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
    private function sortByName($a, $b)
    {
        return strcmp($a->getName(), $b->getName());
    }
    private function sortByColor($a, $b){
        return strcmp($a->getColor(), $b->getColor());
    }
    public function sortDogsByColor(){
        usort($this->listOfDogs, array($this, 'sortByColor'));
    }
    public function sortDogsByName(){
        usort($this->listOfDogs, array($this, 'sortByName'));
    }
    public function getDogByURL($url){
        foreach($this->listOfDogs as $dog){
            if($dog->getURL() == $url){
                return $dog;
            }
        }
        return null;
    }
}