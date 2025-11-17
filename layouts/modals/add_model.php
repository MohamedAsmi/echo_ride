<div class="modal fade" id="addmodelmodal" tabindex="-1" aria-labelledby="modelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modelLabel">Add New Model</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="addModelForm">
        <div class="modal-body">

          <div class="mb-3">
            <label for="name" class="form-label">Model Name</label>
            <input 
              type="text" 
              class="form-control" 
              id="name" 
              placeholder="Enter model name" 
              name="name" 
              required
            >
          </div>

          <div id="modelMessage" class="alert alert-info d-none"></div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Model</button>
        </div>
      </form>

    </div>
  </div>
</div>



<script>

document.getElementById("addModelForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);
    let messageBox = document.getElementById("modelMessage");

    fetch(BASE_URL + "/addModel.php", {
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
                let modal = bootstrap.Modal.getInstance(document.getElementById('addmodelmodal'));
                modal.hide();
                messageBox.classList.add("d-none");
                location.reload();
            }, 1000);
        }
    })
    .catch(err => console.error(err));
});
</script>
