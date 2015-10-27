<?php
namespace view;
//Prints the gallery
class GalleryView{
    private $listOfDogs;
    private $limitOfDogs = 16;
    private $limitedDogList = array();
    private $nv;

    private $listView = false;

    private static $sort = "GalleryView::Sort";

    public function __construct(\model\ListOfDogs $listOfDogs, \view\NavigationView $nv){
        $this->nv = $nv;
        $this->listOfDogs = $listOfDogs;
    }
    public function setLimit(){
        $startNumber = $this->nv->getPage() * $this->limitOfDogs;
        $this->limitedDogList = $this->listOfDogs->getDogsPageWise($startNumber,$this->limitOfDogs);
    }
    public function renderGallery(){
        if($this->nv->getSingleDog()){
            if($this->listOfDogs->getDogByURL($this->nv->getSingleDog())){
                $this->renderSingleDog($this->listOfDogs->getDogByURL($this->nv->getSingleDog()));
            }
            else{
                $this->renderSomethingsWrong();
            }
        }
        else{
            if($this->listView){

            }
            else{
                echo $this->generatePagingCounter();
                echo"<a href='?".$this->nv->sort."=1'>Sortera efter färg -</a>";
                echo"<a href='?'>Sortera efter namn</a>";
                echo"<h1>Aussiegalleriet</h1>

";
                foreach($this->limitedDogList as $dog){
                    $this->renderGridViewGallery($dog);
                }
            }
        }
    }
    public function renderSingleDog(\model\dog $dog){
        //Url for the back button
        $url = htmlspecialchars($_SERVER['HTTP_REFERER']);

        if($dog->getSex()){
            $dogGender = "Hane";
        }
        else{
            $dogGender = "Tik";
        }
        echo "
	         	<div id='dogpresen'>

				<h1>". $dog->getName()."</h1>
				<h2>Efter: ".$dog->getSire()."  <br>Undan: ".$dog->getDam()."</h2>

			</div>
			<div id='standimg'>
						<img src='images/". $dog->getImageDate()."/" . $dog->getImageLeftURL() . "' class='standimg'>
						<img src='images/". $dog->getImageDate()."/" . $dog->getImageRightURL() . "' class='standimg'>
						<br>
						</div>
				<div id='headandfact'>
						<img src='images/". $dog->getImageDate()."/" . $dog->getImageHeadURL() . "' class='headimg'>

						<ul>
							<li>
							<b>Född:</b> ". $dog->getBirthday()."
							</li>
							<li>
							<b>Kön:</b> ". $dogGender ."
							</li>
							<li>
							<b>Färg:</b> ". $dog->getColor()."
							</li>
							<li>
							<b>Regnr: </b> ". $dog->getRegnr()."
							</li>
							<li>
							<b>Fotad:</b> ".$dog->getImageDate()." i ". $dog->getPhotoPlace()."
							</li>
							<li>
							<b>Ålder på bilden:</b> ". $dog->getAgeInPicture()."
							</li>

						</ul>
						</div>
				<h2><a href='$url'>Tillbaka till galleriet</a></h2>
	         ";
    }
    public function userWantsToSort(){
        return isset($_POST[self::$sort]);
    }
    private function generatePagingCounter(){
        $pagingHTML = "Sida: ";
        if(isset($_Get["page"])){
            unset($_GET["page"]);
        }
        $numberOfPages = ceil(count($this->listOfDogs->getDogs())/$this->limitOfDogs);
        for($i=1; $i<=$numberOfPages;$i++){
            $pagingHTML .= "<a href='". $this->nv->generateLink($i) ."'>- $i </a>";
        }
        $pagingHTML .="-";
        return $pagingHTML;
    }
    private function renderGridViewGallery(\model\Dog $dog){
     echo " <a href='?".$this->nv->dog."=".$dog->getURL()."'><div class='gallerywrapper'>
         <img src='images/thumbnails/".$dog->getImageDate()."/".$dog->getImageLeftURL()."' class='galleryimg'>
         <p>" . $dog->getName(). "</p></a></div>";
    }
    private function renderSomethingsWrong(){
        echo "<h1>Någonting verkar ha blivit fel.<a href='?'>Gå tillbaka till galleriet här.</a></h1>";
    }
}