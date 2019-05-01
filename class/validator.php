<?php

/**
 * 
 */
class Validator
{	

	private $data;

	private $errors;
	
	function __construct($data)
	{
		$this->data = $data;
	}

	//fonction qui teste si il y a des données ou non
	private function getField($field){
		return $this->data[$field];
	}

	public function alphanumeric($field, $errorMsg){
		if (!isset($this->data[$field]) || !preg_match('/^[A-Za-z0-9]+$/', $this->getField($field)) {
			
			//ajout d'un message d'erreur dans la liste $errors
			$this->errors[$field] = $errorMsg;
		}
	}

}