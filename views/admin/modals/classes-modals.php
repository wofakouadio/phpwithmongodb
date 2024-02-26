<?php
    require_once "../../../includes/TokenSession.php";
?>
<!-- create new class -->
<div class="modal fade new-class-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="new-class-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Class | New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['token']; ?>">
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name" name="class-name">
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

<!-- edit class -->
<div class="modal fade edit-class-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="edit-class-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Class | Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="hidden" name="class-id">
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['token']; ?>">
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name" name="class-name">
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Status</label>
                        <select class="form-control form-control-lg wide mb-3" name="class-status">
                            <option value=1>ACTIVE</option>
                            <option value=0>DISABLED</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- delete class -->
<div class="modal fade delete-class-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="delete-class-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Class | Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label class="form-label font-w600" id="class-notice">Notice to delete selected class</label>
                        <input type="hidden" name="class-id">
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['token']; ?>">
                    </div>
                    <div class="col-xl-12 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="soft-delete">
                            <label class="form-check-label">
                                Check me out if you want to delete it permanently. 
                            </label>
                            <small class="text-danger">This action is irreversible</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>