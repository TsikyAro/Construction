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
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Inserer Nouveau Devis</h5>
              <!-- General Form Elements -->
              <form action="<?= base_url('index.php/DevisController/insertiondevis')?>" method="post">
              <div class="row">
                <?php for($i = 0; $i<count($maison);$i++){?>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= $maison[$i]->nommaison?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Pour une dure de : <?= $maison[$i]->duree?> jours</h6>
                                <input class="form-check-input" type="radio" name="maison" value="<?= $maison[$i]->idmaison?>" >
                                <!-- <input type="hidden" name="durre"  value="<?= $maison[$i]->duree?>" > -->
                            </div>
                        </div>
                    </div>
                <?php }?>
              </div>
              <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Choix Finition</label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="finition">
                      <option selected>Voir les Finition</option>
                      <?php for($i = 0;$i<count($finition);$i++){?>
                        <option value="<?= $finition[$i]->idfinition?>"><?= $finition[$i]->nomfinition?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" >Date Debut Construction</label>
                    <div class="col-sm-10">
                        <input type="date" name="datedebut" class="form-control">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div>
                </div>

              </form>
              <!-- End General Form Elements -->

            </div>
          </div>
      </div>
  </section>
</main>