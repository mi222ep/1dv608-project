<?php
namespace controller;

require_once("model/Dog.php");
require_once("model/ListOfDogs.php");
require_once("model/DogDAL.php");
require_once("view/MenuView.php");
require_once("view/LayoutView.php");
require_once("view/GalleryView.php");
require_once("view/NavigationView.php");

class MasterController
{
    private $mysqli;
    private $lv;
    private $gv;
    private $dogs;
    private $nv;

    function __construct()
    {
        $servername = "aussiegalleri-202794.mysql.binero.se";
        $username = "202794_oo25539";
        $password = "gkRQbl09zx";
        $dbname = "202794-aussiegalleri";

        $this->mysqli = new \mysqli($servername, $username, $password, $dbname);
        //Connection for my local enviroment
        //$this->mysqli = new \mysqli("localhost", "test", "123456", "202794-aussiegalleri");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $this->nv = new \view\NavigationView();
        $this->lv = new \view\LayoutView();
        $this->dogs = new \model\ListOfDogs($this->mysqli);
        $this->gv = new \view\GalleryView($this->dogs, $this->nv);
    }
    public function doGallery(){
        if($this->nv->getSortBy()){
            $this->dogs->sortDogsByColor();
        }
        if($this->nv->getSingleDog()){
        }
        $this->gv->setLimit();
        $this->lv->render($this->gv);
    }
    public function doTests()
    {
        $testDogs = new \model\ListOfDogs($this->mysqli);
        $testDogs->_test();
    }
}