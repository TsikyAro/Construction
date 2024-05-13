
<main id="main" class="main">
  <section class="section" id="section" >
    <div class="row">
      <div class="col-lg-12">
          <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Liste Maison / Devis</h5>
                    <!-- Start Table -->
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">
                                Maison
                            </th>
                            <th scope="col">
                               Duree
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if(isset($maison)){?>
                            <?php for($i = 0; $i<count($maison);$i++){?>
                                <tr>
                                  <td><?= $maison[$i]->nommaison?></td>
                                  <td><?= $maison[$i]->duree?></td>
                                  <td><p><a href="<?= base_url('index.php/Admin/detail_travaux')?>?idmaison=<?= $maison[$i]->idmaison?>">Voir les Travaux</a></p></td>
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