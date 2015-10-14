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
    private $photos = array();

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
        echo "<br>" . $this->dogID, $this->name, $this->regnr, $this->sex, $this->color, $this->sire, $this->dam, $this->dayOfBirth;
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
        return $diff->format('%y year, %m month, %d days');
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
    public function getLatestImage(){
        $mostRecentPhoto = null;
        foreach($this->photos as $photo){
            $mostRecentPhoto = $photo->getPhotoDate();
        }
        return $mostRecentPhoto;
    }
    public function getLatestImageURL(){
        $mostRecentPhoto = null;
        foreach($this->photos as $photo){
            $mostRecentPhoto = $photo->getLeftImg();
        }
        return $mostRecentPhoto;
    }
}