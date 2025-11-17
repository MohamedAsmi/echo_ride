<?php 
require_once __DIR__ . '/config.php';


use Models\Reservation;

$reservations = Reservation::getDataWithCustomerAndCar();

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
    <div class="row">
        <div class="text-end col-md-12 mt-3 me-3 p-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcarmodal">
                Add New Car
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategorymodal">
                Add Category
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addmodelmodal">
                Add Model
            </button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcustomermodal">
                Add Customer
            </button>
        </div>
    </div>
      <div class="card-body">
        <table id="invoice" class="display nowrap table table-striped table-bordered" style="width:100%">
          <thead>
            <tr>
                <th>ID</th>
                <th>Booking ID</th>
                <th>Customer</th>
                <th>Car</th>
                <th>Period</th>
                <th>Status</th>
                <th>Invoice</th>
            </tr>
        </thead>
  <tbody>
  <?php foreach ($reservations as $r): ?>
    <tr>
      <td><?=htmlspecialchars($r['id'])?></td>
      <td><?=htmlspecialchars($r['booking_id'])?></td>
      <td><?=htmlspecialchars($r['customer_name'])?></td>
      <td><?=htmlspecialchars($r['car_model'])?></td>
      <td><?=htmlspecialchars($r['start_date'])?> to <?=htmlspecialchars($r['end_date'])?></td>
      <td><?=htmlspecialchars($r['status'])?></td>
      <td><a class="btn" href="http://localhost/Esoft/induvidual/echo_ride/invoice.php?page=invoice&id=<?=urlencode($r['id'])?>">Invoice</a></td>
    </tr>
  <?php endforeach; ?>
          </tbody>
          <tfoot>
             <tr>
                <th>ID</th>
                <th>Booking ID</th>
                <th>Customer</th>
                <th>Car</th>
                <th>Period</th>
                <th>Status</th>
                <th>Invoice</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>


  <?php include 'layouts/script.php'; ?>
  <?php include 'layouts/cars_datatable.php'; ?>  
  

</body>
</html>
