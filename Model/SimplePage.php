<?php
class SimplePage extends SimpleContentAppModel {

	public $name = 'SimplePage';

	public $useTable = 'simple_pages';

	public $displayField = 'title';

	public $validate = array(
			'title' => array(
					'unique' => array(
							'rule' => 'isUnique',
							'required' => 'create',
							'message'  => 'Page title already exists',
					),
					'empty' => array(
							'rule'    => 'notEmpty',
							'message' => 'The page title cannot be left blank'
					)
			)
	);

	public function beforeSave($options = array()) {
		if (!empty($this->data['SimplePage']['title'])){
			$this->data['SimplePage']['key'] = Inflector::slug($this->data['SimplePage']['title']);
		}
		return true;
	}
}