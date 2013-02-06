<?php
class SimpleContentAppController extends AppController {
	
	public function beforeFilter(){
		
		//Define the layout for edit and display functions
		$this->layout = 'default';
		
		//Auth as you will, eg:
		/*
		if($this->request['controller'] == 'simple_pages' AND $this->request['action'] != 'display'){
			if( AuthComponent::user('role') != 'admin' ){
				$this->Session->setFlash(__('Access denied'),'error');
				$this->redirect('/');
			}
		}
		*/
	}
	
}
?>