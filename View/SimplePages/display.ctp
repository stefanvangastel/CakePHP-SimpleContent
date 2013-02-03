<?php 
if(!empty($page['SimplePage']['content'])){
	
	//Title
	echo '<h1>'.$page['SimplePage']['title'].'</h1>';
	
	//Content
	echo $page['SimplePage']['content']; 
}
?>
