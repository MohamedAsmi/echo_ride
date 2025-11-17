<?php 
require_once __DIR__ . '/config.php';


use Models\Car;

$cars = Car::all();

?>

<!doctype html>
<html lang="en">
  <?php include 'layouts/head.php'; ?>
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
            <button class="btn btn-primary">Add new Car</button>
        </div>
    </div>
      <div class="card-body">
        <table id="cars" class="display nowrap table table-striped table-bordered" style="width:100%">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Model</th>
              <th>Category</th>
              <th>Daily</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cars as $c): ?>
                <tr>
                <td><?=htmlspecialchars($c['id'])?></td>
                <td><?=htmlspecialchars($c['model'])?></td>
                <td><?=htmlspecialchars($c['category'])?></td>
                <td><?=htmlspecialchars($c['daily_price'])?></td>
                <td><?=htmlspecialchars($c['status'])?></td>
                <td>
                    <?php if ($c['status'] === 'Available'): ?>
                    <a class="btn" href="http://localhost/Esoft/induvidual/EcoRideCar/public/index.php?page=book&category=<?=urlencode($c['category'])?>">Book</a>
                    <?php else: ?>
                    &mdash;
                    <?php endif; ?>
                </td>
                </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Status</th>
              <th>Action</th>
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
