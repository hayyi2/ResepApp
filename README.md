# Resep App #

Aplikasi mobile hibrit tentang resep. back end dibuat dengan php framework slim, frond end dibuat dengan HTML, CSS, JS framework AngularJs.

### Template ###

1. Resep
2. single
3. user
4. page
5. login
6. register
7. profile
8. input resep
9. setting profile
10. change password
11. category

### Struktur Templating File ###

index.html  
└── template.html  
&emsp;&emsp; ├── login.html  
&emsp;&emsp; ├── register.html  
&emsp;&emsp; ├── profile.html  
&emsp;&emsp; ├── edit-profile.html  
&emsp;&emsp; ├── user.html  
&emsp;&emsp; ├── resep.html  
&emsp;&emsp; ├── category.html  
&emsp;&emsp; ├── single.html  
&emsp;&emsp; └── input-resep.html  

### Url Route Angular App ###

1. /login
2. /register
3. /profile
4. /profile/setting
5. /home
6. /search
7. /favorite
8. /activity
9. /resep/:id
10. /singel/add
11. /singel/edit/:id
12. /category/:id
13. /user/:id

### Database ###

1. resep
2. category
3. options

### API ###

1. get - about
2. post - register
3. post - login
4. get - profile
5. post - setting profile
6. get - beranda
7. get - aktifitas
8. post - add resep
9. put - edit resep
10. delete - delete resep
11. get - favorit
12. get - user
13. get - category
14. post - logout

### Group Api Slim ###

1. about  
&emsp;&emsp; get - register  
2. user  
&emsp;&emsp; post - register  
&emsp;&emsp; post - login  
&emsp;&emsp; post - logout  
&emsp;&emsp; get - profile  
&emsp;&emsp; post - setting profile  
3. resep  
&emsp;&emsp; get - aktifitas  
&emsp;&emsp; post - add resep  
&emsp;&emsp; put - edit resep  
&emsp;&emsp; delete - delete resep  
&emsp;&emsp; get - beranda  
&emsp;&emsp; get - favorit  
&emsp;&emsp; get - user  
&emsp;&emsp; get - category  

### List Fungsi ###

1. about
2. register
3. login
4. profile
5. setting profile
6. beranda
7. aktifitas
8. add resep
9. edit resep
10. delete resep
11. favorit
12. user
13. category
