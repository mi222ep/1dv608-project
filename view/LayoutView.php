<?php
namespace view;
class LayoutView{
    public function __construct(){

    }
    public function render(GalleryView $gv){
        $mv = new MenuView();

        $this->renderHeader();
        $mv->renderMenu();
        $gv->renderGallery();
        $this->renderFooter();
    }
    private function renderHeader(){
        echo"<!DOCTYPE html>
<html>
<head>
	<link href='style/style.css' rel =stylesheet type='text/css'>
	<link rel='icon'
      type='image/png'
      href='/graphic/favicon.png'>
      <meta http-equiv='Content-Type' content='text/html;charset=utf-8' />
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