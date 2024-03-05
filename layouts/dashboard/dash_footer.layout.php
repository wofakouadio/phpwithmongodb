<?php 
    // base url global variable
    include "../../includes/config.php"
    ?>
<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="<?php echo BASE_URL . '/assets/vendor/global/global.min.js'?>"></script>
<script src="<?php echo BASE_URL . '/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js'?>"></script>

<!-- Apex Chart -->
<script src="<?php echo BASE_URL . '/assets/vendor/apexchart/apexchart.js'?>"></script>
<script src="<?php echo BASE_URL . '/assets/vendor/chartjs/chart.bundle.min.js'?>"></script>

<!-- Chart piety plugin files -->
<script src="<?php echo BASE_URL . '/assets/vendor/peity/jquery.peity.min.js'?>"></script>

<!-- Dashboard 1 -->
<script src="<?php echo BASE_URL . '/assets/js/dashboard/dashboard-1.js'?>"></script>

<script src="<?php echo BASE_URL . '/assets/vendor/owl-carousel/owl.carousel.js'?>"></script>

<!-- Material color picker -->
<script src="<?php echo BASE_URL . '/assets/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js'?>"></script>
<script src="<?php echo BASE_URL . '/assets/vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js'?>"></script>

<!-- pickdate -->
<script src="<?php echo BASE_URL . '/assets/vendor/pickadate/picker.js'?>"></script>
<script src="<?php echo BASE_URL . '/assets/vendor/pickadate/picker.time.js'?>"></script>
<script src="<?php echo BASE_URL . '/assets/vendor/pickadate/picker.date.js'?>"></script>

<!-- sweetalert -->
<script src="<?php echo BASE_URL . '/assets/sweetalert2/sweetalert2.all.min.js'?>"></script>

<!-- Datatable -->
<script src="<?php echo BASE_URL . '/assets/vendor/datatables/js/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo BASE_URL . '/assets/js/plugins-init/datatables.init.js'?>"></script>

<script src="<?php echo BASE_URL . '/assets/js/custom.min.js'?>"></script>
<script src="<?php echo BASE_URL . '/assets/js/dlabnav-init.js'?>"></script>

<!-- custom script to get current page name as title name for each page -->
<script src="<?php echo BASE_URL . '/layouts/page_title.script.js'?>"></script>

<!-- custom script to load preloader preset -->
<script>
function JobickCarousel()
	{

		/*  testimonial one function by = owl.carousel.js */
		jQuery('.front-view-slider').owlCarousel({
			loop:false,
			margin:30,
			nav:true,
			autoplaySpeed: 3000,
			navSpeed: 3000,
			autoWidth:true,
			paginationSpeed: 3000,
			slideSpeed: 3000,
			smartSpeed: 3000,
			autoplay: false,
			animateOut: 'fadeOut',
			dots:true,
			navText: ['', ''],
			responsive:{
				0:{
					items:1,
					
					margin:10
				},
				
				480:{
					items:1
				},			
				
				767:{
					items:3
				},
				1750:{
					items:3
				}
			}
		})
	}

	jQuery(window).on('load',function(){
		setTimeout(function(){
			JobickCarousel();
		}, 1000); 
	});
</script>