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
			<div class="media mt-2 mb-2">
				<img class="d-flex mr-3 circle" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1602d0959e7%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1602d0959e7%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213%22%20y%3D%2236.8%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true" style="width: 50px; height: 50px;">
				<div class="media-body">
					<h3 class="mt-0 mb-0">
						Nama User
					</h3>
					<small class="text-secondary">@keroro</small>
				</div>
			</div>
		</div>
		<div class="page-content">
			<?php for ($i=0; $i < 5; $i++): ?>
				<div class="card mb-3">
					<ul class="list-group list-group-flush">
						<img class="card-img-top" src="img/w6.jpg" alt="">
						<li class="list-group-item">
							<h5 class="mt-1 mb-0">
								<div class="dropdown show float-right">
									<a class="dropdown-toggle text-secondary" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<small><i class="fa fa-ellipsis-v fa-fw"></i></small>
									</a>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
										<a class="dropdown-item text-success" href="" ng-click="edit_note(note.boards_note_id)">
											<i class="fa fa-pencil fa-fw"></i> 
											Ubah Resep
										</a>
										<a class="dropdown-item text-danger" href="" ng-click="delete_note(note.boards_note_id)">
											<i class="fa fa-trash fa-fw"></i>
											Hapus Resep
										</a>
									</div>
								</div>
								Media heading
							</h5>
							<small class="text-secondary">30 0ktober 2017 Category Resep</small>
						</li>
						<li class="list-group-item text-center">
							<a href="" class="btn-full text-info"><i class="fa fa-fw fa-heart"></i> 30 Suka</a>
						</li>
					</ul>
				</div>
			<?php endfor ?>
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