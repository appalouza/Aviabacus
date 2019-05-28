


        <div class="form-row">
            <div class="form-group col-md-4">
                <label>Date d'entrée à l'AC</label>
                <input type="Date" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Date de cotisation</label>
                <input type="Date" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label>Date de fin de cotisation</label>
                <input type="Date" class="form-control">
            </div>
        </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>Membre actif:</label>
                    <select>
                        <option>Oui</option>
                        <option>Non</option>
                    </select>
                </div>

                <div class="form-group col-md-2">
                    <label>Boursier:</label>
                    <select >
                        <option>Oui</option>
                        <option>Non</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
	<div class="form-group col-md-6">
		<label>Administration : </label>
		<select class="form-control">
			<option>Membre actif FNA à notre club</option>
			<option>Membre actif FNA ou majoritaire club voisin</option>
			<option>Membre du bureau</option>
			<option>Membre du conseil d'administration</option>
			<option>Membre du conseil d'administration instructeur</option>
			<option>Membre exclu</option>
			<option>Membre non-actif cotisation spéciale</option>
			<option>Membre sans cotisation depuis plus de deux ans</option>
			<option>Membre stagiaire sans cotisation depuis plus de deux ans</option>
			<option>Président</option>
			<option>Président d'honneur</option>
			<option>Vice-président</option>
		</select>
	</div>
            </div>
	<div class="form-group form-check">
		<input type="checkbox" class="form-check-input">
		<label>Fiche à imprimer</label>
	</div>
	<div class="form-group form-check">
		<input type="checkbox" class="form-check-input">
		<label>Compte dans openflyer</label>
	</div>
	<div class="form-group">
		<h2>Liste des avions autorisés</h2>
		 <!-- Trigger the modal with a button -->
<!--  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">Ajouter un avion</button>-->


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="container">
          <div class="modal-header">
          <h4 class="modal-title">Ajouter un avion</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="form-group">
    <label>Avion</label>
    <select class="form-control">
      <option>Selectionnez un avion</option>
        <?php
        //$mysqli = new mysqli('localhost', 'root', '', 'tuto_mdp');
        $dbi->set_charset("utf8");
        $requete = 'SELECT * FROM t_avion';
        $resultat = $dbi->query($requete);
        while ($ligne = $resultat->fetch_assoc()) {
            echo '<option value="'.$ligne['id'].'" >'.$ligne['codavion'].' </option>';
        }


        ?>
    </select>
  </div>


  <div class="form-check">

    <input type="checkbox" class="form-check-input">
    <label class="form-check-label" >Laché Tdp</label>
  </div>
  <div class="form-check">

    <input type="checkbox" class="form-check-input">
    <label class="form-check-label" >Autorisé Local</label>
  </div>
  <div class="form-check">

    <input type="checkbox" class="form-check-input">
    <label class="form-check-label" >Autorisé Nav</label>
  </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>

          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
        </div>

      </div>

    </div>
  </div>
	</div>
	<table class="table">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Avion</th>
                <th scope="col">Laché Tdp</th>
                <th scope="col"> Autorisé local</th>
                <th scope="col">Autorisé Nav</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>


               <tr>
                    <td>F BPRR</td>;
                    <td><input type="checkbox" class="form-check-input" name = "a[]" value="ltdp"> </td>
                    <td><input type="checkbox" class="form-check-input" name = "a[]" value = "aloc"> </td>
                    <td><input type="checkbox" class="form-check-input" name = "a[]" value="anav"> </td>
               </tr>
               <tr>
                    <td>F BDTI</td>
                    <td><input type="checkbox" class="form-check-input" name = "b[]" value="ltdp"></td>
                    <td><input type="checkbox" class="form-check-input" name = "b[]" value = "aloc"></td>
                    <td><input type="checkbox" class="form-check-input" name = "b[]" value="anav"></td>
               </tr>

          <tr>
              <td>F BBQZ</td>
              <td><input type="checkbox" class="form-check-input" name = "c[]" value="ltdp"></td>
              <td><input type="checkbox" class="form-check-input" name = "c[]" value="aloc"></td>
              <td><input type="checkbox" class="form-check-input" name = "c[]" value="anav"></td>
          </tr>
               <tr>
                   <td>F BOPH</td>
                   <td><input type="checkbox" class="form-check-input" name = "d[]" value="ltdp"></td>
                   <td><input type="checkbox" class="form-check-input" name = "d[]" value="aloc"></td>
                   <td><input type="checkbox" class="form-check-input" name = "d[]" value="anav"></td>
               </tr>
            </tbody>
        </table>

