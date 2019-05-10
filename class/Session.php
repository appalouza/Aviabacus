<?php


class Session
{

    static $instance;

    static function getInstance(){

        if(!self::$instance){
            self::$instance = new Session();
        }

        return self::$instance;

    }

    public function __construct(){
        session_start();
    }

    //ajout d'un message flash de succès ou d'échec
    public function setFlash($key, $message){

        $_SESSION['flash'][$key] = $message;

    }

    //vérification du contenu de la variable $_SESSION
    public function hasFlashes(){
        return isset($_SESSION['flash']);
    }

    //renvoei du contenu de la variable $_SESSION puis suppression de son contenu
    public function getFlahes(){
        $flash = $_SESSION['flash'];

        unset($_SESSION['flash']);

        return $flash;
    }

}