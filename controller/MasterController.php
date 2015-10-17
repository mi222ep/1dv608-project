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
    private $mv;
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
        $this->mv = new \view\MenuView();
        $this->nv = new \view\NavigationView();
        $this->lv = new \view\LayoutView();
        $dataBase = new \model\DogDAL($this->mysqli);
        $this->dogs = new \model\Dogs($dataBase);
        $this->gv = new \view\GalleryView($this->dogs);
    }
    public function doGallery(){
        if($this->gv->userWantsToSort()){
            $this->dogs->sortDogs();
        }
        $this->gv->setLimit($this->nv);
        $this->lv->render($this->mv, $this->gv);
    }
    public function doTests()
    {
        $dataBase = new \model\DogDAL($this->mysqli);
        $testDogs = new \model\Dogs($dataBase);
        $testDogs->_test();
    }
}