<h1>detail_travaux</h1>
<form action="<?= base_url("index.php/ExportCsv/import_csv_detail")?>" method="post"  enctype="multipart/form-data">
    <input type="file" name="file" id=""  accept=".csv"> 
    <input type="submit" value="Valider">
</form>

<h1>Devis</h1>
<form action="<?= base_url("index.php/ExportCsv/import_csv_devis")?>" method="post"  enctype="multipart/form-data">
    <input type="file" name="file" id=""  accept=".csv"> 
    <input type="submit" value="Valider">
</form>

<h1>Paiement</h1>
<form action="<?= base_url("index.php/ExportCsv/import_csv_paiement")?>" method="post"  enctype="multipart/form-data">
    <input type="file" name="file" id=""  accept=".csv"> 
    <input type="submit" value="Valider">
</form>