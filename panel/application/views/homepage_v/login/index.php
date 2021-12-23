<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('includes/head'); ?>
</head>
<!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->

<body class="hold-transition lockscreen">

<?php if (isset($_GET['reg']) && isset($_GET['regname'])) { ?>
	<div class="alert alert-success alert-dismissible text-center">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Welcome to Chatbook <?php echo $_GET['regname'] ?>!</h4>
		 Please login to continue
	</div>
<?php } ?>
	<!-- Site wrapper -->
	<div class="wrapper">

		<!-- Content Wrapper. Contains page content -->
		<div class="lockscreen-wrapper">
			<?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
		</div>
		<!-- /.content-wrapper -->
		



		<!-- Add the sidebar's background. This div must be placed
			immediately after the control sidebar -->
			<div class="control-sidebar-bg"></div>
		</div>
		<!-- ./wrapper -->

		<?php $this->load->view('includes/footer'); ?>
		<?php $this->load->view("{$viewFolder}/{$subViewFolder}/page_script"); ?>
	</body>

	</html>