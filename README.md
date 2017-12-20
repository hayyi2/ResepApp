# template

[+] 1. Resep
[+] 2. single
[+] 3. user
[+] 4. page
[+] 5. login
[+] 6. register
[+] 7. profile
[+] 8. input resep
[+] 9. setting profile
[+] 10. change password
[+] 11. category

# struktur

index.html
└── template.html
    ├── login.html
    ├── register.html
    ├── profile.html
    ├── edit-profile.html
    ├── user.html
    ├── resep.html
    ├── category.html
    ├── single.html
    └── input-resep.html

# url app

1.  /login
2.  /register
3.  /profile
4.  /profile/setting
5.  /home
6.  /search
7.  /favorite
8.  /activity
9.  /resep/:id
10. /singel/add
11. /singel/edit/:id
12. /category/:id
13. /user/:id

# database

1. resep
2. category
3. options

# api 

[-] 1. get - about
[-] 2. post - register
[-] 3. post - login
[-] 4. get - profile
[-] 5. post - setting profile
[-] 6. get - beranda
[-] 7. get - aktifitas
[-] 8. post - add resep
[-] 9. put - edit resep
[-] 10. delete - delete resep
[-] 11. get - favorit
[-] 12. get - user
[-] 13. get - category
[-] 14. post - logout

# group api

[-] 1. about
	[-] get - register
[-] 2. user
	[-] post - register
	[-] post - login
	[-] post - logout
	[-] get - profile
	[-] post - setting profile
[-] 3. resep
	[-] get - aktifitas
	[-] post - add resep
	[-] put - edit resep
	[-] delete - delete resep
	[-] get - beranda
	[-] get - favorit
	[-] get - user
	[-] get - category

# app

[-] 1. about
[-] 2. register
[-] 3. login
[-] 4. profile
[-] 5. setting profile
[-] 6. beranda
[-] 7. aktifitas
[-] 8. add resep
[-] 9. edit resep
[-] 10. delete resep
[-] 11. favorit
[-] 12. user
[-] 13. category

# temp
			<!-- counter -->
			<div class="card-columns counter">
				<div class="card clearfix border-primary">
					<div class="card-header border-primary text-white bg-primary clearfix">
						<h1 class="float-right"><i class="fa fa-comments"></i></h1>
						<h1>345</h1>
						<span>New Comments!</span>
					</div>
					<div class="card-footer border-primary">
						<a href="#" class="card-footer-link">
							<i class="float-right fa fa-arrow-right"></i>
							View Details
						</a>
					</div>
				</div>
				<div class="card clearfix border-success">
					<div class="card-header border-success text-white bg-success clearfix">
						<h1 class="float-right"><i class="fa fa-tasks"></i></h1>
						<h1>35</h1>
						<span>New Tasks!</span>
					</div>
					<div class="card-footer border-success">
						<a href="#" class="card-footer-link text-success">
							<i class="float-right fa fa-arrow-right"></i>
							View Details
						</a>
					</div>
				</div>
				<div class="card clearfix border-warning">
					<div class="card-header border-warning text-white bg-warning clearfix">
						<h1 class="float-right"><i class="fa fa-shopping-cart"></i></h1>
						<h1>15</h1>
						<span>New Orders!</span>
					</div>
					<div class="card-footer border-warning">
						<a href="#" class="card-footer-link text-warning">
							<i class="float-right fa fa-arrow-right"></i>
							View Details
						</a>
					</div>
				</div>
				<div class="card clearfix border-danger">
					<div class="card-header border-danger text-white bg-danger clearfix">
						<h1 class="float-right"><i class="fa fa-support"></i></h1>
						<h1>9</h1>
						<span>Support Tickets!</span>
					</div>
					<div class="card-footer border-danger">
						<a href="#" class="card-footer-link text-danger">
							<i class="float-right fa fa-arrow-right"></i>
							View Details
						</a>
					</div>
				</div>
			</div>
			<!-- /counter -->
			<!-- side Traffic -->
			<div class="card">
				<h5 class="card-header">
					side Traffic Overview
				</h5>
				<div class="card-body">
					<div class="canvas-wrapper">
						<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
					</div>
				</div>
			</div>
			<!-- /side Traffic -->
			<!-- widget -->
			<div class="card-columns widget">
				<div class="card">
					<h5 class="card-header">
						Chat
					</h5>
					<div class="card-body">
						lorem
					</div>
				</div>
				<div class="card">
					<h5 class="card-header">
						Timeline
					</h5>
					<div class="card-body">
						lorem
					</div>
				</div>
				<div class="card">
					<h5 class="card-header">
						To-do List
					</h5>
					<div class="card-body">
						lorem
					</div>
				</div>
			</div>
			<!-- /widget -->