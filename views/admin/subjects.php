<?php include "../../includes/config.php" ?>

<?php require_once BASE_URL."/layouts/dashboard/dash_header.layout.php"; ?>

  <?php require_once BASE_URL."/layouts/dashboard/dash_preloader.layout.php"; ?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php require_once BASE_URL."/layouts/dashboard/dash_nav.layout.php"; ?>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		    <!--**********************************
            Chat box start
        ***********************************-->
          <?php require_once BASE_URL."/layouts/dashboard/dash_chats.layout.php" ?>
		    <!--**********************************
            Chat box End
        ***********************************-->
		
		    <!--**********************************
            Header start
        ***********************************-->
          <?php require_once BASE_URL."/layouts/dashboard/dash_heading.layout.php"; ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php require_once BASE_URL."/layouts/dashboard/dash_menu.layout.php"; ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		    <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
			    <div class="container-fluid">
            <div class="row page-titles">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="javascript:void(0)" id="breadcrumb-header">Form</a></li>
                <li class="breadcrumb-item"><a href="javascript:void(0)" id="breadcrumb-title">Element</a></li>
              </ol>
            </div>
            <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-rounded btn-secondary" data-bs-toggle="modal" data-bs-target=".new-subject-modal">
                            <span class="btn-icon-start text-secondary">
                                <i class="fa fa-plus color-secondary"></i>
                            </span> New Subject
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="SubjectsDataTables" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>	
          </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
	
		
        <!--**********************************
            Footer start
        ***********************************-->
        <?php require_once BASE_URL."/layouts/dashboard/dash_version_control.layout.php"; ?>
        <!--**********************************
            Footer end
        ***********************************-->

	    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    <!-- Modal -->
    <?php require_once BASE_URL."/views/admin/modals/subjects-modals.php"; ?>
	
<?php require_once BASE_URL."/layouts/dashboard/dash_footer.layout.php"; ?>

<!-- subject scripts -->
<script src="<?php echo BASE_URL.'/models/subject/js/subjects_script.js'; ?>" ></script>
<!-- subject datatables -->
<script src="<?php echo BASE_URL.'/models/subject/js/subjects_datatables.js'; ?>" ></script>