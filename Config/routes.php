<?php
	//Display route
	Router::connect('/sp/*', array('plugin'=>'simple_content', 'controller' => 'simple_pages', 'action' => 'display'));
	
	//Default route
	Router::connect('/sc/', array('plugin'=>'simple_content', 'controller' => 'simple_pages', 'action' => 'index'));
?>
