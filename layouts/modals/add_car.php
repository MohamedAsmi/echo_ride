<?php 
use Models\K2534814_Category;
use Models\K2534814_Model;
$category = K2534814_Category::all();


$model = K2534814_Model::all();
?>

<div class="modal fade" id="addcarmodal" tabindex="-1" aria-labelledby="addcarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addcarLabel">Add New Car</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="addCarForm">
          <div class="modal-body">
                <div class="mb-3">
                  <label for="model" class="form-label">Model</label>
                  <select name="model" id="model" class="form-select" required>
                    <?php foreach ($model as $m): ?>
                      <option value="<?=htmlspecialchars($m['name'])?>"><?=htmlspecialchars($m['name'])?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="category" class="form-label">Category</label>
                    <?php foreach ($category as $c): ?>
                      <select class="form-select" id="category" name="category" required>
                        <option value="<?=htmlspecialchars($c['name'])?>"><?=htmlspecialchars($c['name'])?></option>
                      <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                  <label for="daily_price" class="form-label">Daily Price</label>
                  <input type="text" class="form-control" id="daily_price" placeholder="Enter Daily Price" name="daily_price" required>
                </div>
                <div class="mb-3">
                  <label for="free_km" class="form-label">Enter Free Km</label>
                  <input type="text" class="form-control" id="free_km" placeholder="Enter Free Km" name="free_km" required>  
                </div>
                 <div class="mb-3">
                  <label for="extra_km_charge" class="form-label">Enter Extra Km Charge</label>
                  <input type="text" class="form-control" id="extra_km_charge" placeholder="Enter Extra Km Charge" name="extra_km_charge" required>  
                </div>
                <div class="mb-3">
                  <label for="tax_rate" class="form-label">Enter Tax Rate</label>
                  <input type="text" class="form-control" id="tax_rate" placeholder="Enter Tax Rate" name="tax_rate" required>  
                </div>
                <div class="mb-3">
                  <label for="status" class="form-label">Status</label>
                  <select name="status" id="status" class="form-select" required>
                    <option value="available">Available</option>
                    <option value="Maintanance">Maintanance</option>
                    <option value="reserved">Reserved</option>
                  </select>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          <div id="carMessage" class="alert alert-info d-none"></div>
        </form>
    </div>
  </div>
</div>


<script>

document.getElementById("addCarForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);
    let messageBox = document.getElementById("carMessage");

    fetch(BASE_URL + "/addCar.php", {
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