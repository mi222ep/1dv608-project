<?php
namespace view;
//Prints the gallery
class GalleryView{
    private $listOfDogs;
    private $limitOfDogs = 12;
    private $limitedDogList = array();
    private $nv;

    private $listView = false;

    private static $sort = "GalleryView::Sort";

    public function __construct(\model\Dogs $listOfDogs, \view\NavigationView $nv){
        $this->nv = $nv;
        $this->listOfDogs = $listOfDogs;
    }
    public function setLimit(){
        $startNumber = $this->nv->getPage() * $this->limitOfDogs;
        $this->limitedDogList = $this->listOfDogs->getDogsPageWise($startNumber,$this->limitOfDogs);
    }
    public function renderGallery(){
        if($this->nv->getSingleDog()){
            $this->renderSingleDog($this->listOfDogs->getDogByURL($this->nv->getSingleDog()));

        }
        else{
            if($this->listView){

            }
            else{
                echo $this->generatePagingCounter();
                echo"<a href='?sort=1'>Sortera plx!</a>";
                echo"<h1>Aussiegalleriet</h1>

";
                foreach($this->limitedDogList as $dog){
                    $this->renderGridViewGallery($dog);
                }
            }
        }


    }
    public function renderSingleDog(\model\dog $dog){

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
				<h2><a href='?'>Tillbaka till galleriet</a></h2>
	         ";
    }
    public function userWantsToSort(){
        return isset($_POST[self::$sort]);
    }
    private function generatePagingCounter(){
        $pagingHTML = "";
        if(isset($_Get["page"])){
            unset($_GET["page"]);
        }
        $numberOfPages = ceil(count($this->listOfDogs->getDogs())/$this->limitOfDogs);
        for($i=1; $i<=$numberOfPages;$i++){
            $pagingHTML .= "<a href='". $this->nv->generateLink($i) ."'>$i</a>";
        }
        return $pagingHTML;
    }
    private function renderGridViewGallery(\model\Dog $dog){
     echo " <a href='?dog=".$dog->getURL()."'><div class='gallerywrapper'>
         <img src='images/thumbnails/".$dog->getImageDate()."/".$dog->getImageLeftURL()."' class='galleryimg'>
         <p>" . $dog->getName(). "</p></a></div>";
    }
}