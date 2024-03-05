<?php
    require_once "../../../includes/TokenSession.php";
?>
<!-- create new class -->
<div class="modal fade new-teacher-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="new-teacher-form" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subject | New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['token']; ?>">
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name" name="subject-name">
                    </div>  
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Code<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="number" class="form-control solid" placeholder="Code" aria-label="code" name="subject-code">
                    </div>                   
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Description</label>
                        <textarea class="form-control solid" rows="5" aria-label="With textarea" name="subject-description" placeholder="Description"></textarea>
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
<div class="modal fade edit-subject-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="edit-subject-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subject | Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="hidden" name="subject-id">
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['token']; ?>">
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name" name="subject-name">
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Code<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="number" class="form-control solid" placeholder="Code" aria-label="code" name="subject-code" readonly>
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Description</label>
                        <textarea class="form-control solid" rows="5" aria-label="With textarea" name="subject-description"></textarea>
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Status</label>
                        <select class="form-control form-control-lg wide mb-3" name="subject-status">
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
<div class="modal fade delete-subject-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="delete-subject-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Subject | Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label class="form-label font-w600" id="subject-notice">Notice to delete selected class</label>
                        <input type="hidden" name="subject-id">
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