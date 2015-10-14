<?php
namespace view;
class LayoutView{
    public function __construct(){

    }
    public function render(MenuView $mv, GalleryView $gv){
        $this->renderHeader();
        $mv->renderMenu();
        $gv->renderGallery();
        $this->renderFOoter();
    }
    private function renderHeader(){
        echo"<!DOCTYPE html>
<html>
<head>
	<link href='style/style.css' rel =stylesheet type='text/css'>
	<link rel='icon'
      type='image/png'
      href='/graphic/favicon.png'>
	<title>Aussiegalleri.se</title>
</head>
<body>
 <div id='contentwrapper'>";
    }
    private function renderFooter(){
        echo" </div>
 </body>
 </html>";
    }
}