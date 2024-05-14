
<main id="main" class="main">
  <section class="section" id="section" >
    <h2>Choisir le methode de payement du devis :<?= $devis?></h2>
    <div class="row">
      <div class="col-lg-8">
        <?php if(isset($notification)){?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $notification?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php }?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Insertion Payemnet</h5>
              <!-- General Form Elements -->
              <form action="<?= base_url('index.php/DevisController/methode')?>" method="post">
                <div class="row mb-4">
                  <label >Choix Payement</label>
                    <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example" name="type">
                        <option selected>Voir les Choix possible </option>
                            <option value="0">Payer La totalite</option>
                            <option value="1">Payer en Partielle</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="devis" value="<?=$devis?>">
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>
                </div>

              </form>
              <!-- End General Form Elements -->

            </div>
          </div>
          <div class="card">
                <div class="card-body">
                    <!-- <h5 class="card-title">Liste Marque</h5>/ -->
                <!-- Start Table -->
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">A Payer</th>
                        <th scope="col">Reste a Payer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($payement)){?>
                        <?php for($i = 0; $i<count($payement);$i++){?>
                            <tr>
                                <td><?= number_format($payement[$i]->somme_total,2,'.',' ')?></td>
                                <td><?= number_format($payement[$i]->reste_payer,2,'.',' ')?></td>
                                <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered<?=$payement[$i]->iddevis?>">
                                      <i class="bi bi-pen-fill"></i>
                                </button>
                                  <!-- Modifier -->
                                    <div class="modal fade" id="verticalycentered<?=$payement[$i]->iddevis?>" tabindex="-1">
                                      <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title">Payer</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <form id="modalForm" class="row" >
                                                <!-- <center> -->
                                                    <div class="modal-body">
                                                        <div class="row" style="margin-left:10px">
                                                            <div class="row mb-3">
                                                                <label for="inputText" >Date de Payment</label>
                                                                <div class="col-sm-10">
                                                                    <input  id="date" type="date" name="date" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="inputText" >Montant</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" id="montant_payer" name="montant" class="form-control">
                                                                    <input type="hidden" id="iddevis" name="iddevis" value="<?= $payement[$i]->iddevis?>" class="form-control">
                                                                    <input type="hidden" id="montant_apayer" name="montantd" value="<?= $payement[$i]->somme_total?>" class="form-control">
                                                                  </div>
                                                            </div>
                                                        </div>
                                                        <div id="message" style="color:red"></div>
                                                    </div>
                                                <!-- </center> -->
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary">Valider</button>
                                                </div>
                                              </form>
                                             
                                          </div>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                        <?php }?>
                        <?php }?>
                    </tbody>
                    </table>
                <!-- End Table with hoverable rows -->
                </div>
                </div>
          </div>
      </div>
  </section>
</main>
<script>
  document.addEventListener("DOMContentLoaded", function() {
      document.getElementById("modalForm").addEventListener("submit", function(event) {
          event.preventDefault(); 
          var date = document.getElementById("date").value;
          var montant_payer = document.getElementById("montant_payer").value;
          var montant_apayer = document.getElementById("montant_apayer").value;
          var iddevis = document.getElementById("iddevis").value;
          var montant_ecart = montant_apayer-montant_payer;
          console.log(montant_ecart);
          console.log(montant_apayer);
          
          // if( montant_ecart < 0){
          //     // console.log("Tsy Mety fa be loatra");
          //     document.getElementById("message").innerText = 'Tsy Mety fa be loatra';
          //     return;
          // } 
          // else if(montant_payer<0){
          //   document.getElementById("message").innerText = 'Valeur Entrer Negatif';
          //     return;
          // }
          // else if(date === ' ' || montant_payer === ' '){
          //     document.getElementById("message").innerText = 'Veuiller Completer les Forme';
          //     return;
          // }
          // Créer un objet XMLHttpRequest pour effectuer une requête AJAX
          var xhr = new XMLHttpRequest();
          xhr.open( "POST" ,"<?= base_url('index.php/DevisController/update')?>", true );
          xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                  var response = JSON.parse(json_decode(xhr.responseText));
                if (response.error) {
                    document.getElementById("message").innerText = response.error;
                } else {
                    document.getElementById("message").innerText = response.success;
                }
              } else {
                  console.error("Erreur de requête AJAX : " + xhr.status);
              }
            }
          };

          // Envoyer les données au serveur
          xhr.send("date=" + encodeURIComponent(date) + "&montant=" + encodeURIComponent(montant_payer)+  "&iddevis=" + encodeURIComponent(iddevis)+"&montant_apayer"+encodeURIComponent(montant_apayer));
    });
  });

</script>