<?php
namespace view;
class NavigationView{
    public $page = "page";
    public $sort = "sort";
    public  $dog = "dog";

    public function getPage(){
        //TODO: safety before all - make sure nothing strange is entered in query strings
        if(ISSET($_GET["page"])){
            return $_GET["page"] - 1;
        }
        return 0;
    }
    public function getSortBy(){
        if(ISSET($_GET[$this->sort])){
            return $_GET[$this->sort];
        }
        return null;
    }
    public function generateLink($page = null, $sort = null){
        $url=strtok($_SERVER["REQUEST_URI"],'?');
        $queryString = array();
        if($page != null){
            $queryString[$this->page] = $page;
        }else{
            if(isset($_GET[$this->page])){
                $queryString[$this->page] = $_GET[$this->page];
            }
        }
        if($sort !=null){
            $queryString[$this->sort] = $sort;
        }
        else{
            if(isset($_GET[$this->sort])){
                $queryString[$this->sort] = $_GET[$this->sort];
            }
        }
        $url .= "?".http_build_query($queryString);
        return $url;
    }
    public function getSingleDog(){
        if(isset($_GET[$this->dog])){
            return $_GET[$this->dog];
        }
        return false;
    }
}