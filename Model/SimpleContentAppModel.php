<?php
class SimpleContentAppModel extends AppModel {
	
	public function errorsToString($validationErrors = null){
		
		$errors = '';
		
		foreach($validationErrors as $field => $error){
			$errors .= '<br />'. ucfirst($field) . ': ' . implode(', ',$error);
		}
		
		return $errors;
	}	
}
?>