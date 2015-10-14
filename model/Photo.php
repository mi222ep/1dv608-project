<?php
namespace model;
class Photo
{
    //headshot, standleft, standright, eventdate, eventplace, eventdescr, photographer, ispuppy (behövs kanske inte?)
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
    public function _test(){
        echo $this->headShot;
    }
}