<?php
$idv = @$_GET['idv'];
$one = Existe('Fille', 'id_fille');

?>
 <h2>
    <span class="glyphicon glyphicon-group" aria-hidden="true"></span>
    Espace Fille
</h2>

<div class="row" style="margin-top: 20px; margin-bottom: 20px; margin-right: 3px;">
    <div class="col-md-13 col-md-offset(-1)">
            <div class="panel panel-primary">
                  <div class="panel-heading">
                        <h3 class="panel-title">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                        Liste des inscris par sections
                        <form action="" method="post" class="form-inline pull-right" style="margin-top: -8px;">
                            <div class="form-group">
                                <label for="section">Sélectionner une section:</label>
                                <select class="form-control" id="section" name="section">
                                    <option value="">Sélectionner</option>
                                    <option value="Section 1">St Ange</option>
                                    <option value="Section 2">St Tharsis</option>
                                    <option value="Section 3">St Kizito</option>
                                    <option value="Section 4">St Dominique</option>
                                    <option value="Section 5">St Vincent</option>
                                    <option value="Section 6">St Joseph</option>
                                    <!-- Add more sections as needed -->
                                </select>
                            </div>
                        </form>
                    </h3>
                  </div>
                  <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Age</th>
                                        <th>Année de Naissance</th>
                                        <th>Numéro</th>
                                        <th>Lieu de résidence</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php
                                    // Assuming you have a function to fetch
                                    $listeGarcon = getFilleList("Fille"); // Fetch
                                    foreach ($listeGarcon as $key => $garcon) {?>
                                        <tr>
                                            <td><?= ($key + 1)?></td>
                                            <td><?= ($garcon['nom'])?></td>
                                            <td><?= ($garcon['prénom'])?></td>
                                            <td><?= (date('Y') - date('Y', strtotime($garcon['date_naissance']))) ?></td>
                                            <td><?= ($garcon['date_naissance'])?></td>
                                            <td><?= ($garcon['tel'])?></td>
                                            <td><?= ($garcon['adresse'])?></td>
                                            <td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        
                  </div>
            </div>
        
            <!-- Add dynamic content for sections garçons here -->
    </div>
</div>