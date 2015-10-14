<?php
namespace view;
class LayoutView{
    public function __construct(){

    }
    public function render(MenuView $mv){
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
<?php
 include('menu.php');
 ?>
 <div id='contentwrapper'>";
        $mv->renderMenu();
        echo" </div>
 </body>
 </html>";
    }
}