<?php
namespace view;
class NavigationView{
    public static $page = "navigationView::page";
    public static $sort = "navigationView::sort";

    public function getPage(){
        //TODO: safety before all - make sure nothing strange is entered in query strings
        if(ISSET($_GET["page"])){
            return $_GET["page"] - 1;
        }
        return 0;
    }
    public function getSortBy(){
        if(ISSET($_GET["sort"])){
            return $_GET["sort"];
        }
        return null;
    }
    public function generateLink($page = null, $sort = null){
        $url=strtok($_SERVER["REQUEST_URI"],'?');
        $queryString = array();
        if($page != null){
            $queryString["page"] = $page;
        }else{
            if(isset($_GET['page'])){
                $queryString["page"] = $_GET['page'];
            }
        }
        if($sort !=null){
            $queryString["sort"] = $sort;
        }
        else{
            if(isset($_GET['sort'])){
                $queryString["sort"] = $_GET['sort'];
            }
        }
        $url .= "?".http_build_query($queryString);
        return $url;
    }
    public function getSingleDog(){
        return isset($_GET["dog"]);
    }
}