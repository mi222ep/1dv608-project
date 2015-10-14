<?php
namespace controller;

require_once("model/Dog.php");
require_once("model/Dogs.php");
require_once("model/DogDAL.php");

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
        $dataBase = new \model\DogDAL($this->mysqli);
        $testDogs = new \model\Dogs($dataBase);
        $testDogs->_test();
    }
}