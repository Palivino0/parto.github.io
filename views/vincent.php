<div class="row">
    <div class="col-md-4">
        <h2>
           <span class="glyphicon glyphicon-group" aria-hidden="true"></span>
           Espace  St Vincent
        </h2>
    </div>
    <div class="col-md-5"></div>
    <div class="col-md-3">
        <?php
          $listeGarconsInscrits = getGarconList('inscris','St Vincent');
          $nombreTotal = count($listeGarconsInscrits);
        ?>

       <div class="total">
        <h2>
         Total: <?= $nombreTotal ?>
        </h2>
       </div>
    </div>
</div>

<div class="row" style="margin-top: 20px; margin-bottom: 20px; margin-right: 3px;">
    <div class="col-md-13 col-md-offset(-1)">
            <div class="panel panel-primary">
                  <div class="panel-heading">
                        <h3 class="panel-title">
                        <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                        Liste
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
                                        <th>Genre</th>
                                        <th>Section</th>
                                        <th>Numéro</th>
                                        <th>Lieu de résidence</th>
                                    </tr>
                                </thead>
                                <?php
                                    // Assuming you have a function to fetch
                                    $liste = getGarconList('inscris','St Vincent'); // Fetch
                                    foreach ($liste as $key => $inscris) {?>
                                        <tr>
                                            <td><?= ($key + 1)?></td>
                                            <td><?= ($inscris['nom'])?></td>
                                            <td><?= ($inscris['prénom'])?></td>
                                            <td><?=(date('Y') - date('Y', strtotime($inscris['date_naissance'])));?></td>
                                            <td><?= ($inscris['date_naissance'])?></td>
                                            <td><?=($inscris['genre'])?></td>
                                            <td><?= ($inscris['section'])?></td>
                                            <td><?= ($inscris['tel'])?></td>
                                            <td><?= ($inscris['adresse'])?></td>
                                            
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