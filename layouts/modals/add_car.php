<?php 
use Models\Category;

$category = Category::all();

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
                  <input type="text" class="form-control" id="model" placeholder="Enter Model" name="model" required>
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
                  <label for="daily_price" class="form-label">Daily</label>
                  <input type="text" class="form-control" id="daily_price" placeholder="Enter Daily Price" name="daily_price" required>
                </div>
                <div class="mb-3">
                  <label for="status" class="form-label">Status</label>
                  <input type="text" class="form-control" id="status" placeholder="Enter Status" name="status" required>
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