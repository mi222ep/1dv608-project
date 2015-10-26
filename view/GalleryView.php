<?php
namespace view;
//Prints the gallery
class GalleryView{
    private $listOfDogs;
    private $limitOfDogs = 12;
    private $limitedDogList = array();
    private $nv;

    private $listView = false;
    private $viewPuppies = false;

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
        echo $this->generatePagingCounter();
        if($this->nv->getSingleDog()){
            $this->renderSingleDog($this->listOfDogs->getDogByURL($this->nv->getSingleDog()));

        }
        if($this->listView){

        }
        else{
            echo"<a href='?sort=1'>Sortera plx!</a>";
            echo"<h1>Aussiegalleriet</h1>

";
            foreach($this->limitedDogList as $dog){
                $this->renderGridViewGallery($dog);
            }
        }

    }
    public function renderSingleDog(\model\dog $dog){
        //$dog = $this->listOfDogs->getDogByURL();

        $dogGender = "testkön";
        echo "
	         	<div id='dogpresen'>

				<h1>". $dog->getName()."</h1>
				<h2>Efter: ".$dog->getSire()."  <br>Undan: ".$dog->getDam()."</h2>

			</div>
			<div id='standimg'>
						<img src='images/". $dog->getLatestImage()."/" . $dog->getLatestImageURL() . "' class='standimg'>
						<img src='images/". $dog->getLatestImage()."/" . $dog->getLatestImageURL() . "' class='standimg'>
						<br>
						</div>
				<div id='headandfact'>
						<img src='images/". $dog->getLatestImage()."/" . $dog->getLatestImageURL() . "' class='headimg'>

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
							<b>Fotad:</b> ". $dogGender."
							</li>
							<li>
							<b>Ålder på bilden:</b> ". $dogGender."
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
         <img src='images/thumbnails/".$dog->getLatestImage()."/".$dog->getLatestImageURL()."' class='galleryimg'>
         <p>" . $dog->getName(). "</p></a></div>";
    }
}