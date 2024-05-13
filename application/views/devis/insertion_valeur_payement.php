
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
                        <th scope="col">Mode de Payement </th>
                        <th scope="col">A Payer</th>
                        <th scope="col">Reste a Payer</th>
                        <th scope="col">Etat Payement</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($payement)){?>
                        <?php for($i = 0; $i<count($payement);$i++){?>
                            <tr>
                                <td><?= $payement_classe->methode($payement[$i]->typepayement)?></td>
                                <td><?= $payement[$i]->somme_total?></td>
                                <td><?= $payement[$i]->reste_payer?></td>
                                <td><?= $payement_classe->etat($payement[$i]->etat)?></td>
                                <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered<?=$payement[$i]->idpayement?>">
                                      <i class="bi bi-pen-fill"></i>
                                </button>
                                  <!-- Modifier -->
                                    <div class="modal fade" id="verticalycentered<?=$payement[$i]->idpayement?>" tabindex="-1">
                                      <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                  <h5 class="modal-title">Payer</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <form id="modalForm" class="row" action="<?= base_url('index.php/DevisController/update')?>" method="post">
                                                <!-- <center> -->
                                                    <div class="modal-body">
                                                        <div class="row" style="margin-left:10px">
                                                            <div class="row mb-3">
                                                                <label for="inputText" >Date de Payment</label>
                                                                <div class="col-sm-10">
                                                                    <input type="date" name="date" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label for="inputText" >Montant</label>
                                                                <div class="col-sm-10">
                                                                    <input type="number" name="montant" class="form-control">
                                                                    <input type="hidden" name="idpayement" value="<?= $payement[$i]->idpayement?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
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