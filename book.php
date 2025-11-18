<?php 
require_once __DIR__ . '/config.php';


use Models\K2534814_Customer;

$customers = K2534814_Customer::all();

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
    <h1 class="mb-3">Book a Car</h1>

    <div class="card">
      <div class="card-body col-md-6">
        <form id="bookCarForm">
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control">
                <?php foreach ($customers as $cust): ?>
                    <option value="<?=htmlspecialchars($cust['id'])?>"><?=htmlspecialchars($cust['name'])?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input 
              type="text" 
              class="form-control" 
              id="category" 
              placeholder="Enter category" 
              name="category" 
              value="<?=htmlspecialchars($_GET['category'] ?? '')?>"
              readonly>
        </div>
        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>
        <div class="mb-3">
            <label for="total_km" class="form-label">Estimated Total Km</label>
            <input type="number" class="form-control" id="total_km" name="total_km" required>
        </div>

        <button type="submit" class="btn btn-primary" id="bookCarBtn">Book Car</button>
        <div id="bookingMessage" class="alert alert-info d-none mt-3"></div>
        </form>
      </div>
      </div>
    </div>
  </div>


  <?php include 'layouts/script.php'; ?>
  <?php include 'layouts/cars_datatable.php'; ?>  
  <script>

document.getElementById("bookCarForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);
    let messageBox = document.getElementById("bookingMessage");

    fetch(BASE_URL + "/AddBook.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(res => {
        messageBox.textContent = res.message;
        messageBox.classList.remove("d-none");

        if(res.status === "success") {
            form.reset();
            setTimeout(() => {
                let modal = bootstrap.Modal.getInstance(document.getElementById('addcategorymodal'));
                modal.hide();
                messageBox.classList.add("d-none");
                location.reload();
            }, 1000);
        }
    })
    .catch(err => console.error(err));
});
</script>

</body>
</html>
