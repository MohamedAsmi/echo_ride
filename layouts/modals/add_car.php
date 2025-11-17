<div class="modal fade" id="addcarmodal" tabindex="-1" aria-labelledby="addcarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addcarLabel">Add New Car</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="" method="post">
            <div class="mb-3">
              <label for="model" class="form-label">Model</label>
              <input type="text" class="form-control" id="model" placeholder="Enter Model" name="model">
            </div>
            <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <input type="text" class="form-control" id="category" placeholder="Enter Category" name="category">
            </div>
            <div class="mb-3">
              <label for="daily_price" class="form-label">Daily</label>
              <input type="text" class="form-control" id="daily_price" placeholder="Enter Daily Price" name="daily_price">
            </div>
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <input type="text" class="form-control" id="status" placeholder="Enter Status" name="status">
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>