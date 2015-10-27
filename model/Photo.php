<?php
namespace model;
class Photo
{
    private $headShot;
    private $leftImg;
    private $rightImg;
    private $eventDate;
    private $eventPlace;
    private $eventDescr;
    private $photographer;
    private $isPuppy;

    public function __construct($headShot, $leftImg, $rightImg, $eventDate, $eventPlace, $eventDescr, $photographer, $isPuppy)
    {
        $this->headShot = $headShot;
        $this->leftImg = $leftImg;
        $this->rightImg = $rightImg;
        $this->eventDate = $eventDate;
        $this->eventPlace = $eventPlace;
        $this->eventDescr = $eventDescr;
        $this->photographer = $photographer;
        $this->isPuppy = $isPuppy;
    }
    //Public GET functions
    public function _test(){
        echo $this->headShot, $this->leftImg, $this->rightImg, $this->eventDate, $this->eventPlace, $this->eventDescr, $this->photographer, $this->isPuppy;
    }
    public function getPhotoDate(){
        return $this->eventDate;
    }
    public function getLeftImg(){
        return $this->leftImg;
    }
    public function getRightImg(){
        return $this->rightImg;
    }
    public function getHeadImg(){
        return $this->headShot;
    }
    public function getPhotoPlace(){
        return $this->eventPlace;
    }
}