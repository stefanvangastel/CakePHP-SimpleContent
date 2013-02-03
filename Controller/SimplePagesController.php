<?php
App::uses('Sanitize', 'Utility');

class SimplePagesController extends SimpleContentAppController {
	
	public $uses = array('SimpleContent.SimplePage'); 
	
	public $helpers = array('Form','Session');

	public function beforeRender(){
		parent::beforeRender();
	}
	
	/**
	 * Create function
	 */
	public function create(){
	
		if ($this->request->is('post') || $this->request->is('put'))
		{
			//Set initial content
			$this->request->data['SimplePage']['content'] = 'Edit this page by clicking here in edit mode';
			
			$this->SimplePage->create();
			if($this->SimplePage->save($this->request->data['SimplePage']))
			{
				$this->Session->setFlash(__('Page "%s" was created',$this->request->data['SimplePage']['title']),'success');
				$this->redirect(array('plugin'=>'simple_content','controller'=>'simple_pages','action'=>'edit',Inflector::slug($this->request->data['SimplePage']['title'])));
			}
		}
		$errors = $this->SimplePage->errorsToString($this->SimplePage->validationErrors);
		$this->Session->setFlash(__('Error creating page: ').$errors,'error');
		$this->redirect($this->referer());
	}
	
	/**
	 * Index function,
	 */
	public function index(){
		//Find all pages
		$this->set('pages',$this->SimplePage->find('all'));
	}
	
	/**
	 * Edit function, also serves as index function (create, edit and delete from this page
	 */
	public function edit($id = null) {
		
		if ($this->request->is('post') || $this->request->is('put')){
		
			$simple_page = $this->SimplePage->findById($id);
			$this->SimplePage->id = $id;
		
			//Clean titel
			$this->request->data['SimplePage']['title'] = strip_tags($this->request->data['SimplePage']['title']);
			
			//Ook key aanpassen:
			$this->request->data['SimplePage']['key'] = Inflector::slug($this->request->data['SimplePage']['title']);
			
			if($this->SimplePage->save($this->request->data['SimplePage'])){
				$this->Session->setFlash(__('Page "%s" saved',$this->request->data['SimplePage']['title']),'success');
			}else{
				$errors = $this->SimplePage->errorsToString($this->SimplePage->validationErrors);
				$this->Session->setFlash(__('Error saving page: ').$errors,'error');
			}
			
			$this->redirect('/sc/');
		}
		
		//Find the page
		$page = $this->SimplePage->findById($id);
			
		if(!$page){
			$this->Session->setFlash(__('Page not found'),'error');
			$this->redirect('/sc/');
		}
		$this->data = $page;
	}
		
	/*
	 * Function to display the contents of a page
	 */
	public function display($id = null) {
		$page = $this->SimplePage->findById($id);
		if(!$page){
			$this->Session->setFlash(__('Page not found'),'error');
			$this->redirect($this->referer());
		}
		
		$this->set('page',$page);
	}
	
	/*
	 * Delete function
	*/
	public function delete($id = null)
	{
		if ($this->request->is('post') || $this->request->is('put')){
			
			$page = $this->SimplePage->findById($id);
			
			if($page){
				if($this->SimplePage->delete($page['SimplePage']['id'])){
					$this->Session->setFlash(__('Page deleted.'),'success');
				}else{
					$this->Session->setFlash(__('Error deleting page'),'error');
				}
			}else{
				$this->Session->setFlash(__('Error deleting page, no page found'),'error');
			}
		}else{
			$this->Session->setFlash(__('Error deleting page, no post or put command'),'error');
		}
		
		$this->redirect($this->referer());
	}
	
}
?>