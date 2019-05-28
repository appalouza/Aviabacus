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

    public function isPhone($field, $errorMsg, $nationalite){
        //les caractères de délimitation tout les 2 chiffres sont le point, le tiret et l'espace
        if ($nationalite == "FR"){
            if (!preg_match("[0][1234589][- \.—]?([0-9][0-9][- \.—]?){4}$", $this->getField($field))) {

                //ajout d'un message d'erreur dans la liste $errors
                $this->errors[$field] = $errorMsg;
            }
        }elseif ($nationalite == "BEL"){
            if (!preg_match("[0][1234589][- \.—]?([0-9][0-9][- \.—]?){4}$", $this->getField($field))) {

                //ajout d'un message d'erreur dans la liste $errors
                $this->errors[$field] = $errorMsg;
            }
        }elseif ($nationalite == "GB"){
            if (!preg_match("[0][1234589][- \.—]?([0-9][0-9][- \.—]?){4}$", $this->getField($field))) {

                //ajout d'un message d'erreur dans la liste $errors
                $this->errors[$field] = $errorMsg;
            }
        }else{
            $this->isNumeric($field, $errorMsg);
        }

    }

	public function isMobilePhone($field, $errorMsg){
	    //les caractères de délimitation tout les 2 chiffres sont le point, le tiret et l'espace
        if (!preg_match('`^(06[-. ]?(\d{2}[-. ]?){3}\d{2})$`', $this->getField($field))) {

            //ajout d'un message d'erreur dans la liste $errors
            $this->errors[$field] = $errorMsg;
        }
    }

	public function isAlpha($field, $errorMsg){
		if (!preg_match('#^[a-zA-Z -]+$#', $this->getField($field))) {
			
			//ajout d'un message d'erreur dans la liste $errors
			$this->errors[$field] = $errorMsg;
		}
	}
    public function isAlphanumeric($field, $errorMsg){
        if (!preg_match('/^[A-Za-z0-9 -]+$/', $this->getField($field))) {

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

    public function isAdmin($field, $errorMsg)
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

    public function isSexe($field, $errorMsg){

	    $sexe = array(0,1);
	    if(!in_array($field, $sexe)){
            $this->errors['sexe'] = $errorMsg;

        }
    }
    public function ismActif($field, $errorMsg){

        $sexe = array(0,1);
        if(!in_array($field, $sexe)){
            $this->errors['mActif'] = $errorMsg;

        }
    }
    public function isBours($field, $errorMsg){

        $sexe = array(0,1);
        if(!in_array($field, $sexe)){
            $this->errors['bours'] = $errorMsg;

        }
    }
    public function isMembre($field, $errorMsg){

        $sexe = array(0,1,2,3,4,5,6,7,8,9,10,11,12);
        if(!in_array($field, $sexe)){
            $this->errors['lMembre'] = $errorMsg;

        }
    }

    public function isDate($field, $errorMsg){
	    if (!var_dump(checkdate($this->getField($field)))){
            $this->errors[$field] = $errorMsg;
        }
    }
    public function isPassword($field, $errorMsg)
    {
        if (empty($this->getField($field))){
            $this->errors[$field] = 'Veuillez rentrer un mot de passe';

        }elseif ($this->getField($field) != $this->getField($field . '_confirm')){
            $this->errors[$field] = 'Les mots de passe sont différents';
        }
        elseif (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,12}$/',  $this->getField($field)))
        {
            $this->errors[$field] = "Votre mot de passe n'est pas assez sécurisé";
        }
}
    public function isPassword2($field, $errorMsg)
    {
        if (empty($this->getField($field))){
            $this->errors[$field] = 'Veuillez rentrer un mot de passe';

        }elseif ($this->getField($field) != $this->getField($field . '-confirm')){
            $this->errors[$field] = 'Les mots de passe sont différents';
            }
        elseif (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,12}$/',  $this->getField($field)))
        {
            $this->errors[$field] = "Votre mot de passe n'est pas assez sécurisé";
        }

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