




<!--   <div class="form-group">
           <picture>
               <img src="img_orange_flowers.jpg" alt="Photo" style="width:auto;">
           </picture>
           <input type="file" name="userProfilPicture" class="form-control">
       </div>-->

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Sexe</label>
        <select class="form-control" name = "sexe">
            <option value="2">Select...</option>
            <option <?php if($pilote['modif']->codsexe == 1 ){echo 'selected=\'selected\'';}?> value=1>Mme.</option>
            <option <?php if($pilote['modif']->codsexe == 0 ){echo 'selected=\'selected\'';}?> value=0>M.</option>
        </select>
    </div>
    <div class="form-group col-md-4" >
        <label >Nom</label>
        <input type="text" name="nom" class="form-control" placeholder="<?php echo $pilote['modif']->nom?>">
    </div>
    <div class="form-group col-md-4">
        <label >Prénom</label>
        <input type="text" name="prenom" class="form-control"  placeholder="<?php echo $pilote['modif']->prenom?>">
    </div>
</div>

<div class="form-group">
    <label >Email</label>
    <input type="text" name="email" class="form-control" placeholder="<?php echo $pilote['modif']->email?>" >
</div>

<div class="form-group">
    <label for="">Niveau</label>
    <select name="lvl_user" class="form-control col-md-4" size="1" required >
        <option >Select...</option>
        <option <?php if($pilote['modif']->level_user == 'Pilote' ){echo 'selected=\'selected\'';}?>>Pilote</option>
        <option <?php if($pilote['modif']->level_user == 'Chef-Pilote' ){echo 'selected=\'selected\'';}?>>Chef-Pilote</option>
        <option <?php if($pilote['modif']->level_user == 'Trésorier' ){echo 'selected=\'selected\'';}?>>Trésorier</option>
        <option <?php if($pilote['modif']->level_user == 'Bureau' ){echo 'selected=\'selected\'';}?>>Bureau</option>
        <option <?php if($pilote['modif']->level_user == 'Administrateur' ){echo 'selected=\'selected\'';}?>>Administrateur</option>
    </select>

</div>



<div class="form-row">
    <div class="form-group col-md-4">
        <label>Nationalité</label>
        <!--<select name="pays" class="form-control col-md-5">
                    <option>Select...</option>
                    <?php
        /*$mysqli = new mysqli('localhost', 'root', '', 'tuto_mdp');
        $dbi->set_charset("utf8");
        $requete = 'SELECT * FROM pays';
        $resultat = $dbi->query($requete);
        while ($ligne = $resultat->fetch_assoc()) {
            echo '<option>'.$ligne['nom_fr_fr'].' </option>';
        }
        $dbi->close();*/
        ?>
                </select>-->
        <input type="text" id="nationalite" name="nationalite" class="form-control" placeholder="<?php echo $pilote['modif']->nationalite?>">
    </div>
</div>


<div class="form-row">
    <div class="form-group col-md-6">
        <label>Adresse</label>
        <input type="text" name="adresse" class="form-control" placeholder="<?php echo $pilote['modif']->adresse?>">
    </div>


    <div class="form-group col-md-3">
        <label >Code postal</label>
        <input type="text" id="cp" size="6" name="codpost" class="form-control" placeholder="<?php echo $pilote['modif']->codpost?>">

    </div>

    <div class="form-group col-md-3">
        <label>Ville</label>
        <input type="text" id="ville" name="ville" class="form-control" placeholder="<?php echo $pilote['modif']->ville?>">

    </div>

</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <label>Téléphone portable</label>
        <input type="tel" name="telcell" class="form-control" placeholder=" <?php echo $pilote['modif']->telcellulaire?>">
    </div>
    <div class="form-group col-md-4">
        <label>Téléphone domicile </label>
        <input type="tel" name="teldom" class="form-control" placeholder=" <?php echo $pilote['modif']->teldomicile?>">
    </div>
    <div class="form-group col-md-4">
        <label>Téléphone professionnel</label>
        <input type="tel" name="telpro" class="form-control"  placeholder=" <?php echo $pilote['modif']->telpro?>">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <label>Profession</label>
        <input type="text" name="profession" class="form-control" placeholder=" <?php echo $pilote['modif']->profession?>">
    </div>

</div>

<div class="form-row">


    <div class="form-group col-md-4">
        <label>Date de naissance</label>

        <input type="date" name="datenaissance" id="DateNais" class="form-control"  value="<?php echo $pilote['modif']->datnaissance?>">

    </div>




    <div class="form-group col-md-4">
        <label>Age</label>
        <input type="number" name="age" id = "Age" class="form-control" placeholder="<?php echo $pilote['modif']->age?>">
    </div>





    <div class="form-group col-md-4">
        <label>Lieu de naissance</label>
        <input type="text" name="lieunaissance" class="form-control" placeholder="<?php echo $pilote['modif']->lieunaissance?>" >
    </div>

</div>



<h3>Personnes à contacter en cas d'accident</h3>
<h4>1er contact</h4>
<div class="form-row">
    <div class="form-group col-md-4">
        <label>Nom</label>
        <input type="text" name="userFirstContactName" class="form-control" placeholder="<?php echo $pilote['modif']->userFirstContactName;?>">
    </div>
    <div class="form-group col-md-4">
        <label>Téléphone</label>
        <input type="tel" name="userFirstContactPhone" class="form-control" placeholder="<?php echo $pilote['modif']->userFirstContactPhone;?>">
    </div>
</div>

<h4>2nd contact</h4>
<div class="form-row">
    <div class="form-group col-md-4">
        <label>Nom</label>
        <input type="text" name="userSecondContactName" class="form-control" placeholder="<?php echo $pilote['modif']->userSecondContactName;?>">
    </div>
    <div class="form-group col-md-4">
        <label>Téléphone</label>
        <input type="tel" name="userSecondContactPhone" class="form-control" placeholder="<?php echo $pilote['modif']->userSecondContactPhone;?>">
    </div>

</div>
<div class="form-group">
    <label>Observations</label>
    <textarea name = "observations" class="form-control" rows="3" placeholder="<?php echo $pilote['modif']->Observations;?>"></textarea>
</div>







