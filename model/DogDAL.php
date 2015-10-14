<?php
namespace model;
class DogDAL{
    private $db;

    //Static database column names
    private static $name = "dog.name";
    private static $regnr = "dog.regnr";
    private static $color = "color.colorSWE";

    public function __construct(\mysqli $db){
        $this->db = $db;
}
    private function getSingleValueFromDB($neededValue, $dogID){
        $temp ="";
        $stmt = $this->db->prepare("select ".$neededValue." from dog
                                                            INNER JOIN images ON dog.dogID = images.dogID
                                                            INNER JOIN color ON dog.colorID = color.colorID
                                                            INNER JOIN event ON images.eventID = event.eventID
                                                            INNER JOIN litter ON dog.litterID = litter.litterID
                                                            INNER JOIN origin ON dog.originID = origin.originID
                                                            INNER JOIN photographer ON images.photographerID = photographer.photographerID
                                                            INNER JOIN tail ON dog.tailID = tail.tailID
                                                            where dog.dogID ='$dogID'");
        if ($stmt === FALSE) {
            throw new \Exception($this->db->error);
        }
        $stmt->execute();
        $stmt->bind_result($password);
        while ($stmt->fetch()) {
            $temp = $password;
        }
        return $temp;
    }
    public function getDogNameFromDB($dogID){
        $name = $this->getSingleValueFromDB(self::$name, $dogID);
        return $name;
    }
    public function getRegnrFromDB($dogID){
        $name = $this->getSingleValueFromDB(self::$regnr, $dogID);
        return $name;
    }
    public function getColorFromDB($dogID){
        $color = $this->getSingleValueFromDB(self::$color, $dogID);
        return $color;
    }
    public function getAllDogs(){
        $listOfDogs = array();
        $stmt = $this->db->prepare("select dog.dogID from dog
                                                            INNER JOIN images ON dog.dogID = images.dogID
                                                            INNER JOIN color ON dog.colorID = color.colorID
                                                            INNER JOIN event ON images.eventID = event.eventID
                                                            INNER JOIN litter ON dog.litterID = litter.litterID
                                                            INNER JOIN origin ON dog.originID = origin.originID
                                                            INNER JOIN photographer ON images.photographerID = photographer.photographerID
                                                            INNER JOIN tail ON dog.tailID = tail.tailID");
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
}