
<main id="main" class="main">
  <section class="section" id="section" >
    <div class="row">
      <div class="col-lg-10">
        <?php if(isset($notification)){?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $notification?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php }?>
          <!-- <div class="card">
            <div class="card-body">
              <h5 class="card-title">Insertion Travaux</h5>
              <form action="<?= base_url('index.php/Admin/insertionTravaux')?>" method="post">
                <div class="row mb-3">
                  <label for="inputText" >Designation</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomMarque" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" >Quantite</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomMarque" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" >Prix Unitaire</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomMarque" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" >Unite</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomMarque" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" >Type</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomMarque" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" >Code</label>
                  <div class="col-sm-10">
                    <input type="text" name="nomMarque" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Valider</button>
                  </div>
                </div>

              </form>

            </div>
          </div> -->
          <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Liste Finition</h5>
                    <!-- Start Table -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">
                              <input type="checkbox" name="id" id="">
                              Nom Finition
                            </th>
                            <th scope="col">
                              <input type="checkbox" name="marque" id="">
                                Pourcentage
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($finition)){?>
                            <?php for($i = 0; $i<count($finition);$i++){?>
                                <tr>
                                  <td><?= $finition[$i]->nomfinition?></td>
                                  <td><?= number_format($finition[$i]->pourcentage,2,'.','')?>%</td>
                                  <td> 
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered<?=$finition[$i]->idfinition?>">
                                      <i class="bi bi-pen-fill"></i>
                                    </button>
                                    <!-- Modifier -->
                                        <div class="modal fade" id="verticalycentered<?=$finition[$i]->idfinition?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modifier</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form id="modalForm" action="<?= base_url('index.php/Admin/update_finition')?>" method="post">
                                                    <div class="modal-body">
                                                      <label for="">Pourcentage</label>
                                                        <input type="text" name="pourcentage" id="nomMarque" class="form-control" value="<?=$finition[$i]->pourcentage?>">
                                                        <input type="hidden" name="idfinition" id="idfinition" value="<?=$finition[$i]->idfinition?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Valider</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- End Modifier -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentereds<?=$finition[$i]->idfinition?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        </td>
                                    <!-- Suprimer -->
                                    <div class="modal fade" id="verticalycentereds<?=$finition[$i]->idfinition?>" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <center><h2 style="color:red; margin-top:35px">Vous etes sur de suprimer <?=$finition[$i]->nomfinition ?>?</h2></center>
                                                <form id="modalForm" action="<?= base_url('index.php/Admin/delete_finition')?>" method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="idfinition" id="idfinition" value="<?=$finition[$i]->idfinition?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Valider</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Suprimer -->
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

