<?php
require '../../inc/bootstrap.php';
require "../../inc/functions.php";
logged_admin();
require "../../inc/GestionMenu.php";
?>

<div class="container">
		<h1>Licences - Visite médicale</h1>

		<form>
			<div class="form-row">
			<div class=" form-group col">
				<label>Validité de la licence TT/PPL</label>
				<div class="input-group mb-1">
					<div class="input-group-prepend">
						<div class="input-group-text">Début</div>
						<input type="date" class="form-control">
					</div>
				</div>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">Fin</div>
						<input type="date" class="form-control">
					</div>
				</div>
			</div>

			<div class=" form-group col">
				<label>Validité de la licence FFA</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">Début</div>
						<input type="date" class="form-control">
					</div>
				</div>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">Fin</div>
						<input type="date" class="form-control">
					</div>
				</div>
			</div>
			<div class=" form-group col">
				<label>Validité de la visite médicale</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">Début</div>
						<input type="date" class="form-control">
					</div>
				</div>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">Fin</div>
						<input type="date" class="form-control">
					</div>
				</div>
			</div>

	 	 </div>
	 	 <div class="form-group col-6">
			<label>Nom du médecin</label>
			<input type="text" class="form-control">
		</div>
		<div class="form-group col-6">
			<label>Réstrictions "éventuelles</label>
			<textarea class="form-control" rows="3"></textarea>
		</div>


		<div class="form-group">
			<H2>Liste des qualifications</H2>
			<!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">Ajouter une qualification</button>


<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">


      <!-- Modal content-->
      <div class="modal-content">
        <div class="container">
          <div class="modal-header">
          <h4 class="modal-title">Ajouter une qualification</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>
        <div class="form-group">
    <label>Brevet/Qualification</label>
    <select class="form-control">
      <option>Ancien Breveté brevet de base</option>
      <option>Ancien stagiaire déclaré</option>
      <option>Breveté pilote brevet de base</option>
      <option>CPL Pilote pro</option>
      <option>Stagiaire déclaré</option>
      <option>Hydravion</option>
      <option>Qualification IFR</option>
      <option>Instructeur FI, FI R et FE</option>
      <option>A préciser. Non connu</option>
      <option>Qualification B</option>
      <option>Qualification Nuit</option>
      <option>Qualification QRRI</option>
      <option>Breveté pilote complet TT/PPL</option>
      <option>Breveté pilote ULM</option>

    </select>
  </div>
  <div class="form-group">
    <label>Date d'optention</label>
    <input type="date" class="form-control">

  </div>
  <div class="form-group">
  	<label>Numéro</label>
  	<input type="number" class="form-control" >
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
		<thead>
			<tr>
				<th scope="col">Brevets/Qualifications</th>
				<th scope="col">Date d'obtention</th>
				<th scope="col">Numéro</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Hydravion</td>
				<td>17/08/2015</td>
				<td>BH879AH6</td>
				<td><button type="button" class="btn btn-outline-danger btn-sm">Supprimer</button></td>
			</tr>

		</tbody>
	</table>
<button type="submit" class="btn btn-primary">Enregistrer</button>


		</form>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item ">
                <a class="page-link" href="AéroclubInscription.php" >Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="Inscription_coordonnées.php">1</a></li>
            <li class="page-item "><a class="page-link" href="AéroclubInscription.php">2</a></li>
            <li class="page-item active"><a class="page-link" href="Inscription_licence.php">3</a></li>
            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
     </div>

<?php require "../../inc/newFooter.php" ?>