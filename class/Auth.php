<?php
require "../inc/functions.php";

class Auth{


    private $db;

    function __construct($db)
    {
        $this->db = $db;
    }

    public function register($table,$username,$userfirstname,$userlastname, $password, $email, $lvl_user){
        //hash du mot de passe renseigné
        $password = password_hash($password, PASSWORD_BCRYPT);
        $db = App::getDatabase();
        //création d'un token random
        $token = Str::random(60);
        $db->query("INSERT INTO $table 
            SET username= ? , userfirstname = ?, userlastname = ?, email = ?, password = ?, confirmation_token=?, lvl_user=?",
            [$username,
            $userfirstname,
            $userlastname,
            $email,
            $password,
            $token,
            $lvl_user]);
        $db->query('SELECT * FROM users WHERE username = ?',[$_POST['username']])->fetch();

        //récupération de l'id de l'user
        $user_id = $db->lastInsertId();


        // Préparation du mail contenant le lien d'activation
        $header = "MIME-Version: 1.0\r\n";
        $header.='From:"Aviabacus.com"<confirmation@compte.fr'."\n";
        $header.='Content-Type:text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';
        $destinataire = "antoine.quetin@gmail.com";
        $sujet = "Activer votre compte" ;
        $entete = "From: inscription@votresite.com" ;

        // Le lien d'activation est composé du login(log) et de la clé(cle)
        $message = '
                <html>
                    <body>
                    <div align="center">
                        Bienvenue sur Aviabacus 2, <br />
 
                Pour activer votre compte, veuillez cliquer sur le lien ci dessous
                ou copier/coller dans votre navigateur internet. <br/>
 
                http://localhost/log_utilisateurs/page/confirm.php?id='.$user_id.'&token='.$token.'<br/>
 
 
                ---------------
                Ceci est un mail automatique, Merci de ne pas y répondre.
                    </div>
                          
                    </body>
                </html>       ';

        mail("test.aviabacus@gmail.com", "Confirmation du compte", $message, $header) ; // Envoi du mail

    }

    public function register_2($userfirstname,$userlastname,$nationalite, $email,$ville, $teldomicile,$telcellulaire, $profession, $datnaissance, $lieunaissance, $age, $lvl_user){

        //hash du mot de passe renseigné

        $db = App::getDatabase();

        //création d'un token random
        $token = Str::random(60);
        $db->query("INSERT INTO t_pilote 
            SET nom= ? , prenom = ?, ville = ?, teldomicile = ?, telcellulaire = ?, email=?, profession=?, datnaissance=?, age=?, lieunaissance=?, nationalite=?, level_user=?,confirmation_token=? ",
            [$userlastname,
                $userfirstname,
                $ville,
                $teldomicile,
                $telcellulaire,
                $email,
                $profession,
                $datnaissance,
                $age,
                $lieunaissance,
                $nationalite,
                $lvl_user,
                $token]);

        //récupération de l'id de l'user
        $user_id = $db->lastInsertId();
        //$db->query('SELECT * FROM t_pilote WHERE id = ?',[$user_id])->fetch();

        // Préparation du mail contenant le lien d'activation
        $header = "MIME-Version: 1.0\r\n";
        $header.='From:"Aviabacus.com"<confirmation@compte.fr'."\n";
        $header.='Content-Type:text/html; charset="utf-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';

        // Le lien d'activation est composé du login(log) et de la clé(cle)
        $message = '
                <html>
                    <body>
                    <div align="center">
                        Bienvenue sur Aviabacus 2, <br />
 
                Pour activer votre compte et choisir votre mot de passe, veuillez cliquer sur le lien ci dessous
                ou copier/coller dans votre navigateur internet. <br/>
 
                http://localhost/log_utilisateurs/page/confirm_2.php?id='.$user_id.'&token='.$token.'<br/>
 
 
                ---------------
                Ceci est un mail automatique, Merci de ne pas y répondre.
                    </div>
                          
                    </body>
                </html>       ';

        mail("test.aviabacus@gmail.com", "Confirmation du compte", $message, $header) ; // Envoi du mail

    }




}