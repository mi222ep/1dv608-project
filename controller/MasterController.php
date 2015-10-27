<?php
namespace controller;

require_once("model/Dog.php");
require_once("model/Dogs.php");
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
        $this->mysqli = new \mysqli("localhost", "test", "123456", "202794-aussiegalleri");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $this->nv = new \view\NavigationView();
        $this->lv = new \view\LayoutView();
        $this->dogs = new \model\Dogs($this->mysqli);
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
        $testDogs = new \model\Dogs($this->mysqli);
        $testDogs->_test();
    }
}