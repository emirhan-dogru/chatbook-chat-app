<!DOCTYPE html>
<html>

<head>
	<?php $this->load->view('includes/head'); ?>
</head>
<!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->

<body class="hold-transition skin-blue layout-boxed sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo base_url(); ?>" class="logo">
				<span class="logo-lg"><b>Chat</b>book</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Header -->
						<?php $this->load->view("includes/header") ?>
						<!-- Header end -->
					</ul>
				</div>
			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<?php $this->load->view("includes/aside") ?>
		</aside>

		<!-- =============================================== -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer p-0 m-0 ">
			<strong>Copyright &copy; <a href="https://www.instagram.com/eemirhandogru/">Chatbook</a></strong> 2021 <b>Emirhan Doğru</b>
		</footer>
		<!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
		<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->
	<?php $this->load->view('includes/footer'); ?>
</body>

</html>