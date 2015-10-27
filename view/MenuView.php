<?php
namespace view;
class MenuView{
    public function __construct(){

    }
    public function renderMenu(){
        echo"<div id='menuwrapper'>

<div id='contentwrapper2'>
<img src='/graphic/aussie-logo.png' id='logo'>
		<nav>
			<ul>
				<li><a href='?'>Hem</a></li>
				<li><a href='?'>Galleriet</a></li>
				<li><a href='?'>Valpgalleriet</a></li>
				<li><a href='?'>Om galleriet</a></li>
			</ul>
		</nav>

		</div>
		<hr>
	</div>";
    }
}