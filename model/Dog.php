<?php
namespace model;
class Dog{
    private $dogID;
    private $name;
    private $url;
    private $regnr;
    private $sex;
    private $color;
    private $sire;
    private $dam;
    private $dayOfBirth;
    //Prepared for future function to show multiple photos
    private $photos = array();

    //Get methods to get different information from dogs
    public function __construct($dogID, $name, $url, $regnr, $sex, $color, $sire, $dam, $dayOfBirth){
        $this->dogID = $dogID;
        $this->name =$name;
        $this->url = $url;
        $this->regnr=$regnr;
        $this->sex=$sex;
        $this->color=$color;
        $this->sire=$sire;
        $this->dam=$dam;
        $this->dayOfBirth=$dayOfBirth;
    }
    public function _test(){
        echo "<br>" . $this->dogID, $this->name, $this->url, $this->regnr, $this->sex, $this->color, $this->sire, $this->dam, $this->dayOfBirth;
        echo "<br>PHOTOS";
        foreach($this->photos as $photo){
            echo"<br>". $this->getAge($photo->getPhotoDate());
            $photo->_test();
        }
        echo "<br>";
    }
    public function getAge($otherDate){
        $date1Timestamp = date_create($this->dayOfBirth);
        $date2Timestamp = date_create($otherDate);
        $diff = date_diff($date1Timestamp, $date2Timestamp);
        return $diff->format('%y år, %m månader, %d dagar');
    }
    public function addPhoto($photo){
        $this->photos[] = $photo;
    }
    public function getID(){
        return $this->dogID;
    }
    public function getURL(){
        return $this->url;
    }
    public function getName(){
        return $this->name;
    }
    public function getColor(){
        return $this->color;
    }
    public function getImageDate(){
        $mostRecentPhoto = null;
        foreach($this->photos as $photo){
            $mostRecentPhoto = $photo->getPhotoDate();
        }
        return $mostRecentPhoto;
    }
    public function getImageLeftURL(){
        $mostRecentPhoto = null;
        foreach($this->photos as $photo){
            $mostRecentPhoto = $photo->getLeftImg();
        }
        return $mostRecentPhoto;
    }
    public function getImageRightURL(){
        $mostRecentPhoto = null;
        foreach($this->photos as $photo){
            $mostRecentPhoto = $photo->getRightImg();
        }
        return $mostRecentPhoto;
    }
    public function getImageHeadURL(){
        $mostRecentPhoto = null;
        foreach($this->photos as $photo){
            $mostRecentPhoto = $photo->getHeadImg();
        }
        return $mostRecentPhoto;
    }
    public function getSire(){
        return $this->sire;
    }
    public function getDam(){
        return $this->dam;
    }
    public function getBirthday(){
        return $this->dayOfBirth;
    }
    public function getRegnr(){
        return $this->regnr;
    }
    public function getSex(){
        return $this->sex;
    }
    public function getAgeInPicture(){
        return $this->getAge($this->getImageDate());
    }
    public function getPhotoPlace(){
        $mostRecentPhoto = null;
        foreach($this->photos as $photo){
            $mostRecentPhoto = $photo->getPhotoPlace();
        }
        return $mostRecentPhoto;
    }
}