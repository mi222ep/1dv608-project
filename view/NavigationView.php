<?php
namespace view;
class NavigationView{
    public function getPage(){
        if(ISSET($_GET["page"])){
            return $_GET["page"] - 1;
        }
        return 0;
    }
}