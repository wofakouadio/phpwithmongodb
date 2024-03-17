<?php
    require_once "../../../includes/TokenSession.php";
?>
<!-- create new class -->
<div class="modal fade new-teacher-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="new-teacher-form" enctype="multipart/form-data">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Teacher | New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <label  class="form-label font-w600">Staff ID</label>
                            <input type="text" class="form-control solid" placeholder="Staff ID" aria-label="name" name="teacher-staff-id">
                            <input type="hidden" name="_token" value="<?php echo $_SESSION['token']; ?>">
                        </div> 
                        <div class="col-md-4 mb-4">
                            <label  class="form-label font-w600">Firstname<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="Firstname" aria-label="name" name="teacher-firstname">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label  class="form-label font-w600">Surname<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="Surname" aria-label="name" name="teacher-surname">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label  class="form-label font-w600">Date of Birth<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="date" class="form-control solid" placeholder="2017-06-04" aria-label="name" name="teacher-dob" id="mdate">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label  class="form-label font-w600">Place of Birth<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" name="teacher-pob">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label  class="form-label font-w600">Hometown<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" name="teacher-hometown">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label  class="form-label font-w600">Gender<span class="text-danger scale5 ms-2">*</span></label>
                            <div class="mb-3 mb-0">
                                <label class="radio-inline me-3"><input type="radio" name="teacher-gender" class="form-check-input" value="Male"> Male</label>
                                <label class="radio-inline me-3"><input type="radio" name="teacher-gender" class="form-check-input" value="Female"> Female</label>
                            </div>
                        </div> 
                        <div class="col-md-8 mb-4">
                            <label  class="form-label font-w600">Address<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="Address" name="teacher-address">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label  class="form-label font-w600">Email<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" placeholder="user@mail.com" aria-label="name" name="teacher-email">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label  class="form-label font-w600">Contact<span class="text-danger scale5 ms-2">*</span></label>
                            <input type="text" class="form-control solid" name="teacher-contact">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label  class="form-label font-w600">Profile</label>
                            <input class="form-control" type="file" id="teacher-profile" name="teacher-profile">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label  class="form-label font-w600">ID Card</label>
                            <input class="form-control" type="file" id="teacher-id-profile" name="teacher-id-profile">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label  class="form-label font-w600">Department<span class="text-danger scale5 ms-2">*</span></label>
                            <select class="form-control wide" name="teacher-department" id="teacher-department">
                                <!-- <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option> -->
                            </select>
                        </div>
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
<div class="modal fade edit-teacher-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="edit-teacher-form">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Teacher | Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Name<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="hidden" name="teacher-id">
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['token']; ?>">
                        <input type="text" class="form-control solid" placeholder="Name" aria-label="name" name="teacher-name">
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Code<span class="text-danger scale5 ms-2">*</span></label>
                        <input type="number" class="form-control solid" placeholder="Code" aria-label="code" name="teacher-code" readonly>
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Description</label>
                        <textarea class="form-control solid" rows="5" aria-label="With textarea" name="teacher-description"></textarea>
                    </div>
                    <div class="col-xl-12 mb-4">
                        <label  class="form-label font-w600">Status</label>
                        <select class="form-control form-control-lg wide mb-3" name="teacher-status">
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
<div class="modal fade delete-teacher-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" id="delete-teacher-form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Teacher | Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 mb-4">
                        <label class="form-label font-w600" id="teacher-notice">Notice to delete selected class</label>
                        <input type="hidden" name="teacher-id">
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