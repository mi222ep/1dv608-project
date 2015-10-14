<?php
namespace view;
//Prints the gallery
class GalleryView{
    private $listOfDogs;
    private $limitOfDogs = 12;
    private $limitedDogList = array();

    public function __construct(\model\Dogs $listOfDogs){
        $this->listOfDogs = $listOfDogs;
    }
    public function setLimit(){
        $this->limitedDogList = $this->listOfDogs->getDogsPageWise(0,$this->limitOfDogs);
    }
    public function renderGallery(){
        echo"<h1>Aussiegalleriet</h1>
<div id='gallwrapper''></div>";

        foreach($this->limitedDogList as $dog){
           echo " <a href='/test/aussie.php?dog='".$dog->getURL()."><div class='gallerywrapper'>
         <img src='images/thumbnails/".$dog->getLatestImage()."/".$dog->getLatestImageURL()."' class='galleryimg'>
         <p>" . $dog->getName(). "</p></a></div>";
        }
    }
}