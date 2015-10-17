<?php
namespace view;
//Prints the gallery
class GalleryView{
    private $listOfDogs;
    private $limitOfDogs = 12;
    private $limitedDogList = array();

    private $listView = false;
    private $viewPuppies = false;

    private static $sort = "GalleryView::Sort";

    public function __construct(\model\Dogs $listOfDogs){
        $this->listOfDogs = $listOfDogs;
    }
    public function setLimit(\view\NavigationView $nv){
        $startNumber = $nv->getPage() * $this->limitOfDogs;
        $this->limitedDogList = $this->listOfDogs->getDogsPageWise($startNumber,$this->limitOfDogs);
    }
    public function renderGallery(){
        echo $this->generatePagingCounter();
        echo"<h1>Aussiegalleriet</h1>
<div id='gallwrapper''></div>
<form method='post'>
<input type='submit' name='".self::$sort."' value='Sort'/> <br></form>
    <h2>xx/xx hundar visas sida <a href='?page=1'>-1-</a><a href='?page=2'>-2-</a></h2>
";
        foreach($this->limitedDogList as $dog){
           echo " <a href='/test/aussie.php?dog='".$dog->getURL()."><div class='gallerywrapper'>
         <img src='images/thumbnails/".$dog->getLatestImage()."/".$dog->getLatestImageURL()."' class='galleryimg'>
         <p>" . $dog->getName(). "</p></a></div>";
        }
    }
    public function userWantsToSort(){
        return isset($_POST[self::$sort]);
    }
    public function generatePagingCounter(){
        $pagingHTML = "";
        $numberOfPages = ceil(count($this->listOfDogs->getDogs())/$this->limitOfDogs);
        for($i=1; $i<=$numberOfPages;$i++){
            $pagingHTML .= "<a href='?page=$i'>$i</a>";
        }
        return $pagingHTML;
    }
}