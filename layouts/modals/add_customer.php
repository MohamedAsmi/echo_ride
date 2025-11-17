<div class="modal fade" id="addcustomermodal" tabindex="-1" aria-labelledby="addcustomerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addcustomerLabel">Add New Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form id="addCustomerForm">
          <div class="modal-body">
                <div class="mb-3">
                  <label for="nic_passport" class="form-label">NIC/Passport</label>
                  <input type="text" class="form-control" id="nic_passport" placeholder="Enter NIC/Passport" name="nic_passport" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>  
                </div>
                 <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>  
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" required> 
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          <div id="customerMessage" class="alert alert-info d-none"></div>
        </form>
    </div>
  </div>
</div>


<script>

document.getElementById("addCustomerForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);
    let messageBox = document.getElementById("customerMessage");

    fetch(BASE_URL + "/addCustomer.php", {
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
                let modal = bootstrap.Modal.getInstance(document.getElementById('addCustomerModal'));
                modal.hide();
                messageBox.classList.add("d-none");
                location.reload();
            }, 1000);
        }
    })
    .catch(err => console.error(err));
});
</script>