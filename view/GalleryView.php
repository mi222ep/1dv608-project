<?php
namespace view;
class GalleryView{
    private $listOfDogs = array();

    public function __construct(\model\Dogs $listOfDogs){
        $this->listOfDogs = $listOfDogs->getDogs();
    }
    public function renderGallery(){
        echo"<h1>Aussiegalleriet</h1>
<div id='gallwrapper''></div>";

        foreach($this->listOfDogs as $dog){
            echo "en hund!";
        }
    }
}