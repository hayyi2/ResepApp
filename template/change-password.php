<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Dashboard - Master Dashboard Template</title>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="css/style.css" rel="stylesheet">
	<!-- Custom Fonts -->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
<header class="clearfix">
	<nav class="navbar navbar-expand-lg fixed-top navbar-dark">
		<a class="navbar-toggler" aria-label="Toggle navigation" side-nav-toggle>
			<span class="navbar-toggler-icon"></span>
		</a>
		<a class="navbar-brand" href="dashboard.php">Dashmaster</a>

		<div class="float-right">
			<ul class="navbar-nav">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle text-nowrap" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="icon-menu avatar"><i class="fa fa-user fa-fw"></i></div>
						&nbsp;
						<span>Keroro Gunsou</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="#"><i class="fa fa-sign-in fa-fw"></i> Masuk</a>
						<a class="dropdown-item" href="#"><i class="fa fa-user-plus fa-fw"></i> Daftar</a>
					</div>
				</li>
			</ul>
		</div>

		<ul class="side-nav">
			<li class="nav-item active">
				<a class="nav-link" href="dashboard.php"><i class="fa fa-home fa-fw"></i> Beranda</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="dashboard.php"><i class="fa fa-tasks fa-fw"></i> Aktifitas</a>
			</li>
			<div class="dropdown-divider"></div>
			<li class="nav-item">
				<a class="nav-link" href="forms.php"><i class="fa fa-heart fa-fw"></i> Favorite</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="forms.php"><i class="fa fa-cutlery fa-fw"></i> Makanan</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="forms.php"><i class="fa fa-coffee fa-fw"></i> Minuman</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="forms.php"><i class="fa fa-birthday-cake fa-fw"></i> Kue</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="forms.php"><i class="fa fa-leaf fa-fw"></i> Sayur</a>
			</li>
			<div class="dropdown-divider"></div>
			<li class="nav-item">
				<a class="nav-link" href="forms.php"><i class="fa fa-info-circle fa-fw"></i> Tentang</a>
			</li>
		</ul>
	</nav>
</header>
<div class="body">
	<div class="container-fluid">
		<div class="page-title">
			<h2>
				<i class="fa fa-fw fa-key"></i> Ubah Password
			</h2>
		</div>
		<div class="page-content">
			<form class="mb-3">
				<div class="form-group">
					<label>Password Lama</label>
					<input type="password" class="form-control" placeholder="Password Lama">
				</div>
				<div class="form-group">
					<label>Password Baru</label>
					<input type="password" class="form-control" placeholder="Password Baru">
				</div>
				<div class="form-group">
					<label>Ulangi Password</label>
					<input type="password" class="form-control" placeholder="Ulangi Password">
				</div>
				<div class="form-group mt-4">
					<button type="submit" class="btn btn-primary btn-block"><i class="fa fa-fw fa-key"></i> Ubah Password</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
