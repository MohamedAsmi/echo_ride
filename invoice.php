<?php 
require_once __DIR__ . '/config.php';
use Models\Invoice;

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$message = '';
try {
    if ($id) {
        $info = Invoice::generateFromReservation($id);
    }
} catch (\Throwable $e) {
    $message = 'Error: ' . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">
  <?php include 'layouts/head.php'; ?>
  <?php include 'layouts/modals/add_car.php'; ?>
  <?php include 'layouts/modals/add_category.php'; ?>
  <?php include 'layouts/modals/add_model.php'; ?>
  <?php include 'layouts/modals/add_customer.php'; ?>
  <style>
   <?php include 'layouts/style.css'; ?>
  </style>
<body>
   <?php include 'layouts/nav.php'; ?>

  <div class="container">
    <h1 class="mb-3">EcoRide Car Rental System</h1>

    <div class="card">
      <div class="card-body">
        <div class="row">
  <div class="col-md-8">
    <h2>Invoice</h2>
    <?php if ($message): ?><div class="alert alert-danger"><?=htmlspecialchars($message)?></div><?php endif; ?>
    <?php if (!empty($info)): ?>
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Invoice #<?=htmlspecialchars($info['invoice_id'])?></h5>
          <p class="mb-1"><strong>Car:</strong> <?=htmlspecialchars($info['car']['model'])?> (<?=htmlspecialchars($info['car']['category'])?>)</p>
          <p class="mb-1"><strong>Rental Days:</strong> <?=htmlspecialchars($info['reservation']['days'])?></p>
          <hr>
          <p class="mb-1"><strong>Base:</strong> LKR <?=number_format($info['base'],2)?></p>
          <p class="mb-1"><strong>Extra Km:</strong> <?=htmlspecialchars($info['extra_km'])?> → LKR <?=number_format($info['extra_charge'],2)?></p>
          <p class="mb-1"><strong>Discount:</strong> LKR <?=number_format($info['discount'],2)?></p>
          <p class="mb-1"><strong>Tax:</strong> LKR <?=number_format($info['tax'],2)?></p>
          <p class="mb-1"><strong>Deposit:</strong> LKR <?=number_format($info['deposit'],2)?></p>
          <hr>
          <h4 class="text-success">Total Payable: LKR <?=number_format($info['total'],2)?></h4>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>
         </div>
    </div>
  </div>


  <?php include 'layouts/script.php'; ?>
  <?php include 'layouts/cars_datatable.php'; ?>  
  

</body>
</html>
