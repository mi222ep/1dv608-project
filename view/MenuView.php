<?php
namespace view;
class MenuView{
    public function __construct(){

    }
    public function renderMenu(){
        echo"<div id='menuwrapper'>

<div id='contentwrapper2'>
<img src='graphic/aussie-logo.png' id='logo'>
		<nav>
			<ul>
				<li><a href='index.php'>Hem</a></li>
				<li><a href='gallery.php'>Galleriet</a></li>
				<li><a href='puppygallery.php'>Valpgalleriet</a></li>
				<li><a href='about.php'>Om galleriet</a></li>
			</ul>
		</nav>

		</div>
		<hr>
	</div>";
    }
}