<?php
namespace model;
//Retrieves info from database, return dogs
require_once("Photo.php");
class DogDAL{
    private $db;

    //Static database column names
    private static $name = "dog.name";
    private static $url = "dog.url";
    private static $regnr = "dog.regnr";
    private static $color = "color.colorSWE";
    private static $sex = "dog.isBitch";
    private static $sire = "litter.sire";
    private static $dam = "litter.dam";
    private static $dateOfBirth ="litter.born";

    private static $headShot = "images.headShot";
    private static $standLeft= "images.standLeft";
    private static $standRight = "images.standRight";
    private static $eventDate = "event.date";
    private static $eventPlace ="event.place";
    private static $eventDescr ="event.event";
    private static $photographer = "photographer.name";
    private static $isPuppy ="images.isPuppy";

    public function __construct(\mysqli $db){
        $this->db = $db;
}
    public function getAllDogs(){
        $listOfDogs = array();
        $stmt = $this->db->prepare("select dog.dogID from dog");
        if ($stmt === FALSE) {
            throw new \Exception($this->db->error);
        }
        $stmt->execute();
        $stmt->bind_result($dog);
        while ($stmt->fetch()) {
            $listOfDogs[] =$dog;
        }
        return $listOfDogs;
    }
    public function getSingleDog($dogID){
        $stmt = $this->db->prepare("select ".self::$name.",
                                           ".self::$url.",
                                           ".self::$regnr.",
                                           ".self::$color.",
                                           ".self::$sex.",
                                           ".self::$sire.",
                                           ".self::$dam.",
                                           ".self::$dateOfBirth."
                                                            from dog
                                                            INNER JOIN color ON dog.colorID = color.colorID
                                                            INNER JOIN litter ON dog.litterID = litter.litterID
                                                            INNER JOIN origin ON dog.originID = origin.originID
                                                            INNER JOIN tail ON dog.tailID = tail.tailID
                                                            where dog.dogID ='$dogID'");
        if ($stmt === FALSE) {
            throw new \Exception($this->db->error);
        }
        $stmt->execute();
        $stmt->bind_result($dog, $url, $regnr, $color, $sex, $sire, $dam, $born);
        while($stmt->fetch()){
            $dog = new Dog(
                $dogID,
                $this->encodeToIso($dog),
                $this->encodeToIso($url),
                $regnr,
                $sex,
                $this->encodeToIso($color),
                $this->encodeToIso($sire),
                $this->encodeToIso($dam),
                $born);
            return $dog;
        }
        return null;
    }
    public function encodeToIso($string) {
        return mb_convert_encoding($string, "ISO-8859-1", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
    }
    public function addNewPhotos(Dog $dog){
        $dogID = $dog->getID();
        $stmt = $this->db->prepare("select ".self::$headShot.",
                                           ".self::$standLeft.",
                                           ".self::$standRight.",
                                           ".self::$eventPlace.",
                                           ".self::$eventDate.",
                                           ".self::$eventDescr.",
                                           ".self::$photographer.",
                                           ".self::$isPuppy."
                                                            from dog
                                                            INNER JOIN images ON dog.dogID = images.dogID
                                                            INNER JOIN event ON images.eventID = event.eventID
                                                            INNER JOIN photographer ON images.photographerID = photographer.photographerID
                                                            where dog.dogID ='$dogID'");
        if ($stmt === FALSE) {
            throw new \Exception($this->db->error);
        }
        $stmt->execute();
        $stmt->bind_result($headshot, $standLeft, $standRight, $eventPlace, $eventDate, $eventDescr, $photographer, $isPuppy);
        while($stmt->fetch()){
            $photo = new Photo(
                $headshot,
                $standLeft,
                $standRight,
                $eventDate,
                $this->encodeToIso($eventPlace),
                $this->encodeToIso($eventDescr),
                $this->encodeToIso($photographer),
                $isPuppy);
            $dog->addPhoto($photo);
        }
    }
}