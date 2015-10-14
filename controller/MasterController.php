<?php
namespace controller;
use model\Dog;
use model\DogDAL;

require_once("model/Dog.php");
require_once("model/Dogs.php");

class MasterController
{
    private $mysqli;

    function __construct()
    {
        $this->mysqli = new \mysqli("localhost", "test", "123456", "202794-aussiegalleri");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }

    public function doTests()
    {
        $dataBase = new DogDAL($this->mysqli);
        //$testDog = new Dog($dataBase);
        //$testDog->_test();
        $testDogs = new \model\Dogs($dataBase);
        $testDogs->_test();
    }
}