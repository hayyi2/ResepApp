angular.module('myApp')
.config(function($routeProvider){
	$routeProvider
    .when("/beranda", {
		templateUrl:'partials/resep-list.html',
		controller:'BerandaController',
    })
    .when("/category/:id", {
		templateUrl:'partials/resep-list.html',
		controller:'CategoryController',
    })
    .when("/login", {
		templateUrl:'partials/login.html',
		controller:'LoginController',
    })
    .when("/logout", {
		templateUrl:'partials/login.html',
		controller:'LogoutController',
    })
    .when("/register", {
		templateUrl:'partials/register.html',
		controller:'RegisterController',
    })
    .when("/register", {
		templateUrl:'partials/register.html',
		controller:'RegisterController',
    })
    .when("/profile", {
		templateUrl:'partials/profile.html',
		controller:'ProfileController',
    })
    .when("/setting/profile", {
		templateUrl:'partials/setting-profile.html',
		controller:'SettingProfileController',
    })
    .when("/setting/password", {
		templateUrl:'partials/setting-password.html',
		controller:'SettingPasswordController',
    })
    .when("/activity", {
		templateUrl:'partials/user-resep.html',
		controller:'ActivityController',
    })
    .when("/user/:id", {
		templateUrl:'partials/user-resep.html',
		controller:'ResepUserController',
    })
    .when("/resep/:id", {
		templateUrl:'partials/single-resep.html',
		controller:'ResepController',
    })
    .when("/add/resep", {
		templateUrl:'partials/input-resep.html',
		controller:'AddResepController',
    })
    .when("/edit/resep/:id", {
		templateUrl:'partials/input-resep.html',
		controller:'EditResepController',
    })
    .when("/delete/resep/:id", {
		templateUrl:'partials/confirm.html',
		controller:'DeleteResepController',
    })
    .when("/about", {
		templateUrl:'partials/about.html',
		controller:'AboutController',
    })
    .otherwise({ redirectTo: '/beranda' });
});
