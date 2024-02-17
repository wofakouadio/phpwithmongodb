<!-- create new department -->
<div class="modal fade new-department-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="new-department-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Departments | New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name" name="department-name">
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Description</label>
                        <textarea class="form-control solid" rows="5" aria-label="With textarea" name="department-description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
