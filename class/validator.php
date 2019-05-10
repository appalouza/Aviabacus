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
	    if (!isset($this->data[$field])){
	        return null;
        }
		return $this->data[$field];
	}

	public function isAlphanumeric($field, $errorMsg){
		if (!preg_match('/^[A-Za-z]+$/', $this->getField($field))) {
			
			//ajout d'un message d'erreur dans la liste $errors
			$this->errors[$field] = $errorMsg;
		}
	}
    public function isNumeric($field, $errorMsg){
        if (!preg_match('/^[0-9]+$/', $this->getField($field))) {

            //ajout d'un message d'erreur dans la liste $errors
            $this->errors[$field] = $errorMsg;
        }
    }

    public function isLen($field,$errorMsg){
        if (!preg_match('#^[0-9]{5}$#', $this->getField($field))) {
            //ajout d'un message d'erreur dans la liste $errors
            $this->errors[$field] = $errorMsg;
        }
    }

	public function isUniq($field,$db, $errorMsg){
        //envoie et reception de la requête
        $record = $db->query("SELECT id FROM t_pilote WHERE $field = ?",[$this->getField($field)])->fetch();

        if ($record) {

            $this->errors[$field] = $errorMsg;
        }

    }

    public function isLevel($field, $errorMsg)
    {
        if(empty($this->getField($field))){

            $this->errors[$field] = $errorMsg;
        }
    }

    public function isEmail($field, $errorMsg)
    {
        //this getField renvoie null sur le la variable n'existe pas
        if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)) {

            $this->errors[$field] = $errorMsg;
        }
    }


    public function isPassword($field, $errorMsg)
    {
        if (empty($this->getField($field)) || $this->getField($field) != $this->getField($field . '-confirm')){

            $this->errors[$field] = $errorMsg;
        }
        /*if(!empty($this->getField($field))&& $this->getField($field) == $this->getField($field . '_confirm') ){
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#', $this->getField($field))){

                    $_SESSION['flash']['success']="Votre mot de passe à été changé";}
                else{
                    $this->errors[$field] = "Votre mot de passe est non conforme";
                }
            }
        else{
            $this->errors[$field] = $errorMsg;

        }*/
}
    public function isPassword2($field, $errorMsg)
    {
        if (empty($this->getField($field)) || $this->getField($field) != $this->getField($field . '_new_confirm')){

            $this->errors[$field] = $errorMsg;
        }
        /*if(!empty($this->getField($field))&& $this->getField($field) == $this->getField($field . '_confirm') ){
            if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{6,}$#', $this->getField($field))){

                    $_SESSION['flash']['success']="Votre mot de passe à été changé";}
                else{
                    $this->errors[$field] = "Votre mot de passe est non conforme";
                }
            }
        else{
            $this->errors[$field] = $errorMsg;

        }*/
    }



    public function isValid()
    {
        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

}