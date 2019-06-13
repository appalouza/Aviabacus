


        <div class="form-row">
            <div class=" form-group col">
                <label>Validité de la licence TT/PPL</label>
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Début</div>
                        <input type="date" required name="datvaliditeppl" class="form-control">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fin</div>
                        <input type="date" required name="datfinvaliditeppl" class="form-control">
                    </div>
                </div>
            </div>

            <div class=" form-group col">
                <label>Validité de la licence FFA</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Début</div>
                        <input type="date" required name="datvaliditelicence" class="form-control">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fin</div>
                        <input type="date" required name="datfinvaliditelicence" class="form-control">
                    </div>
                </div>
            </div>
            <div class=" form-group col">
                <label>Validité de la visite médicale</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Début</div>
                        <input type="date" required name="datvaliditevisitemed" class="form-control">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Fin</div>
                        <input type="date" required name="datfinvaliditevisitemed" class="form-control">
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group col-6">
            <label>Nom du médecin</label>
            <input type="text" name="nom_medecin" class="form-control" required>
        </div>
        <div class="form-group col-6">
            <label>Réstrictions "éventuelles</label>
            <textarea class="form-control" name="restrictions_medicales" rows="3" required></textarea>
        </div>


        <div class="form-group">
       <!--     <H2>Liste des qualifications</H2>
             Trigger the modal with a button
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#myModal">Ajouter une qualification</button>


             Modal
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">

                    Modal content
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
        -->
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
                <td><select class="form-control"  name="Aqualif">
                        <option value="0"></option>
                        <option value="1">Ancien Breveté brevet de base</option>
                        <option value="2">Ancien stagiaire déclaré</option>
                        <option value="3">Breveté pilote brevet de base</option>
                        <option value="4">CPL Pilote pro</option>
                        <option value="5">Stagiaire déclaré</option>
                        <option value="6">Hydravion</option>
                        <option value="7">Qualification IFR</option>
                        <option value="8">Instructeur FI, FI R et FE</option>
                        <option value="9">A préciser. Non connu</option>
                        <option value="10">Qualification B</option>
                        <option value="11">Qualification Nuit</option>
                        <option value="12">Qualification QRRI</option>
                        <option value="13">Breveté pilote complet TT/PPL</option>
                        <option value="14">Breveté pilote ULM</option>

                    </select></td>

                <td><input type="date" name="AdateValidite"  class="form-control"></td>
                <td><input type="text" name="Anumero" class="form-control"></td>
                <!--<td><button type="button" class="btn btn-outline-danger btn-sm">Supprimer</button></td>-->
            </tr>
            <tr>
                <td><select class="form-control"  name="Bqualif">
                        <option value="0"></option>
                        <option value="1">Ancien Breveté brevet de base</option>
                        <option value="2">Ancien stagiaire déclaré</option>
                        <option value="3">Breveté pilote brevet de base</option>
                        <option value="4">CPL Pilote pro</option>
                        <option value="5">Stagiaire déclaré</option>
                        <option value="6">Hydravion</option>
                        <option value="7">Qualification IFR</option>
                        <option value="8">Instructeur FI, FI R et FE</option>
                        <option value="9">A préciser. Non connu</option>
                        <option value="10">Qualification B</option>
                        <option value="11">Qualification Nuit</option>
                        <option value="12">Qualification QRRI</option>
                        <option value="13">Breveté pilote complet TT/PPL</option>
                        <option value="14">Breveté pilote ULM</option>

                    </select></td>

                <td><input type="date" name="BdateValidite"  class="form-control"></td>
                <td><input type="text" name="Bnumero" class="form-control"></td>
                <!--<td><button type="button" class="btn btn-outline-danger btn-sm">Supprimer</button></td>-->
            </tr>
            <tr>
                <td><select class="form-control"  name="Cqualif">
                        <option value="0"></option>
                        <option value="1">Ancien Breveté brevet de base</option>
                        <option value="2">Ancien stagiaire déclaré</option>
                        <option value="3">Breveté pilote brevet de base</option>
                        <option value="4">CPL Pilote pro</option>
                        <option value="5">Stagiaire déclaré</option>
                        <option value="6">Hydravion</option>
                        <option value="7">Qualification IFR</option>
                        <option value="8">Instructeur FI, FI R et FE</option>
                        <option value="9">A préciser. Non connu</option>
                        <option value="10">Qualification B</option>
                        <option value="11">Qualification Nuit</option>
                        <option value="12">Qualification QRRI</option>
                        <option value="13">Breveté pilote complet TT/PPL</option>
                        <option value="14">Breveté pilote ULM</option>

                    </select></td>

                <td><input type="date" name="CdateValidite"  class="form-control"></td>
                <td><input type="text" name="Cnumero" class="form-control"></td>
                <!--<td><button type="button" class="btn btn-outline-danger btn-sm">Supprimer</button></td>-->
            </tr>
            <tr>
                <td><select class="form-control"  name="Dqualif">
                        <option></option>
                        <option value="1">Ancien Breveté brevet de base</option>
                        <option value="2">Ancien stagiaire déclaré</option>
                        <option value="3">Breveté pilote brevet de base</option>
                        <option value="4">CPL Pilote pro</option>
                        <option value="5">Stagiaire déclaré</option>
                        <option value="6">Hydravion</option>
                        <option value="7">Qualification IFR</option>
                        <option value="8">Instructeur FI, FI R et FE</option>
                        <option value="9">A préciser. Non connu</option>
                        <option value="10">Qualification B</option>
                        <option value="11">Qualification Nuit</option>
                        <option value="12">Qualification QRRI</option>
                        <option value="13">Breveté pilote complet TT/PPL</option>
                        <option value="14">Breveté pilote ULM</option>

                    </select></td>

                <td><input type="date" name="DdateValidite"  class="form-control"></td>
                <td><input type="text" name="Dnumero" class="form-control"></td>
                <!--<td><button type="button" class="btn btn-outline-danger btn-sm">Supprimer</button></td>-->
            </tr>

            </tbody>
        </table>




