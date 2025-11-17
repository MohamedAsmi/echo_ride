<!doctype html>
<html lang="en">
  <?php include 'layouts/head.php'; ?>
  <style>
   <?php include 'layouts/style.css'; ?>
  </style>
<body>
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
            <!-- Sample rows -->
            <tr>
                <td>1</td>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
            </tr>
          
          
            <!-- add more rows as needed -->
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
