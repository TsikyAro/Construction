<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-8">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                            <h5 class="card-title">Montant Total des Devis</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                <h6><?= number_format($somme->somme,2,'.',' ')?> ARIARY</h6>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Revenue Card -->
                    <div class="col-xxl-4 col-md-8">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                            <h5 class="card-title">Montant Total Payement Effectuer</h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="ps-3">
                                <h6><?= number_format($somme_payer->somme,2,'.',' ')?> ARIARY</h6>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>  
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Histogramme</h5>
              <canvas id="lineChart" style="max-height: 400px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                    var labels = [];
                    var values = [];
                    <?php foreach ($statistique as $item): ?>
                        labels.push("<?php echo $item->libele; ?>");
                        values.push(<?php echo $item->total; ?>);
                    <?php endforeach; ?>

                    // Utilisez les tableaux JS pour créer le graphique
                    new Chart(document.querySelector('#lineChart'), {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Line Chart',
                                data: values,
                                fill: false,
                                borderColor: 'rgb(255, 99, 132)',
                                backgroundColor: [
                                'rgba(255, 99, 132, 0.2)'],
                                tension: 0.1,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
              </script>
              <!-- End Line CHart -->
            </div>
          </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form id="anneeForm" action="<?= base_url('index.php/Admin/annes')?>" method="post">
                        <div class="form-group">
                            <br><br>
                            <label for="anneeSelect">Choisissez une année :</label>
                            <select class="form-control" name="annee" id="anneeSelect">
                                <option value="1">Tous voir</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <!-- Ajoutez ici d'autres années si nécessaire -->
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Obtenir les statistiques</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
            
        </div>
    </section>
        </div>
    </section>
</main>