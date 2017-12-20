angular.module('myApp')
.controller('TemplateController', function($scope, $rootScope, $http){
	$rootScope.activeSideNav = '';
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));

	$rootScope.urlUpload = API + 'uploads/';

	$rootScope.side_nav_toggle = function () {
		if ($rootScope.activeSideNav == '') {
			$rootScope.activeSideNav = 'active-side-nav';
		}else{
			$rootScope.activeSideNav = '';
		}
	}
	$rootScope.side_nav_remove = function () {
		$rootScope.activeSideNav = '';
	}

	$rootScope.close_message = function() {
		$rootScope.message = false;
	}

	$http({
        method : 'GET',
        url : API + "category",
    }).then(function successCallback(response) {
    	$rootScope.categories = response.data;
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    });
})
.controller('BerandaController', function($scope, $rootScope, $http){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.activeMenu = 'beranda';
	$rootScope.titlePage = 'Beranda';
	$rootScope.iconPage = 'fa-home';
	$rootScope.subtitleGroup = "";
	$rootScope.hideCategory = false;
	$rootScope.titleMedia = false;

	$http({
        method : 'GET',
        url : API + "resep",
    }).then(function successCallback(response) {
    	$rootScope.resep = response.data;
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    });
})
// .controller('FavoriteController', function($scope, $rootScope){
// 	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
// 	$rootScope.activeMenu = 'favorite';
// 	$rootScope.titlePage = 'Favorit';
// 	$rootScope.iconPage = 'fa-heart';
// 	$rootScope.titleMedia = false;
// })
.controller('CategoryController', function($scope, $rootScope, $routeParams, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$http({
        method : 'GET',
        url : API + "category/" + $routeParams.id,
    }).then(function successCallback(response) {
		$rootScope.activeMenu = 'category'+ response.data.kategori_id;
		$rootScope.titlePage = response.data.nama;
		$rootScope.iconPage = response.data.icon;
		$rootScope.subtitleGroup = response.data.jumlah_resep + " Resep";
		$rootScope.hideCategory = true;

		$http({
	        method : 'GET',
	        url : API + "resep/category/" + $routeParams.id,
	    }).then(function successCallback(response) {
	    	$rootScope.resep = response.data;
	    }, function errorCallback(response) {
	    	$rootScope.message = {
	    		type : 'danger',
	    		data : response.data,
	    	};
	    });
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    	$location.path('/beranda');
    });
})
.controller('LoginController', function($scope, $rootScope, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'login';
	$rootScope.titlePage = 'Masuk';
	$rootScope.iconPage = 'fa-sign-in';
	$rootScope.subtitleGroup = "";
	$scope.login = function () {
		data = {
			'username' : $scope.username,
			'password' : $scope.password,
		};
		$http({
            method : 'POST',
            url : API + "login",
            data : data
        }).then(function successCallback(response) {
            localStorage.setItem('auth', JSON.stringify({
                userid : response.data.userid,
                token : response.data.token
            }));
            
            $rootScope.authData = JSON.parse(localStorage.getItem('auth'));

            $rootScope.message = {
                type : 'success',
                data : "Success Login."
            }
    		$location.path('/activity');
			$scope.username = "";
			$scope.password = "";
        }, function errorCallback(response) {
            $rootScope.message = {
                type : 'danger',
                data : response.data
            }
        });
	}
})
.controller('LogoutController', function($scope, $rootScope, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$http({
        method : 'POST',
        url : API + "logout",
        headers : JSON.parse(localStorage.getItem('auth')),
    }).then(function successCallback(response) {
    	localStorage.removeItem('auth');
        $rootScope.authData = JSON.parse(localStorage.getItem('auth'));
		$location.path('/login');
        $rootScope.message = {
            type : 'success',
            data : "Success logout."
        }
		$location.path('/login');
    }, function errorCallback(response) {
        $rootScope.message = {
            type : 'danger',
            data : response.data
        }
		$location.path('/activity');
    });
})
.controller('RegisterController', function($scope, $rootScope, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'register';
	$rootScope.titlePage = 'Daftar';
	$rootScope.iconPage = 'fa-user-plus';
	$rootScope.subtitleGroup = "";
	$scope.register = function () {
		data = {
			'nama' 		: $scope.nama,
			'username' 	: $scope.username,
			'password' 	: $scope.password,
		};
		if ( $scope.password !=  $scope.repeat ) {
            $rootScope.message = {
                type : 'danger',
                data : "Pengulangan password salah."
            }
		}else{
			$http({
	            method : 'POST',
	            url : API + "register",
	            data : data
	        }).then(function successCallback(response) {
	            localStorage.setItem('auth', JSON.stringify({
	                userid : response.data.userid,
	                token : response.data.token
	            }));
	            
	            $rootScope.authData = JSON.parse(localStorage.getItem('auth'));

	            $rootScope.message = {
	                type : 'success',
	                data : "Success Daftar."
	            }
	    		$location.path('/activity');
				$scope.nama 	= "";
				$scope.username = "";
				$scope.password = "";
				$scope.repeat 	= "";
	        }, function errorCallback(response) {
	            $rootScope.message = {
	                type : 'danger',
	                data : response.data
	            }
	        });
		}
	}
})
.controller('ProfileController', function($scope, $rootScope, $http){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'profile';
	$rootScope.titlePage = 'Profil';
	$rootScope.iconPage = 'fa-user';
	$rootScope.subtitleGroup = "";

	$http({
        method : 'GET',
        url : API + "profile",
        headers : JSON.parse(localStorage.getItem('auth')),
    }).then(function successCallback(response) {
    	$scope.data = response.data;
    }, function errorCallback(response) {
        $rootScope.message = {
            type : 'danger',
            data : response.data
        }
		$location.path('/activity');
    });
})
.controller('SettingProfileController', function($scope, $rootScope, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'setting-profile';
	$rootScope.titlePage = 'Seting Profil';
	$rootScope.iconPage = 'fa-cog';
	$rootScope.subtitleGroup = "";

	$http({
        method : 'GET',
        url : API + "profile",
        headers : JSON.parse(localStorage.getItem('auth')),
    }).then(function successCallback(response) {
    	$scope.data = response.data;
    }, function errorCallback(response) {
        $rootScope.message = {
            type : 'danger',
            data : response.data
        }
		$location.path('/activity');
    });

    $scope.setingProfile = function () {
    	data = {
    		'nama' : $scope.data.nama,
    	}
    	
		$http({
	        method : 'POST',
	        url : API + "setting/profile",
	        data : data,
	        headers : JSON.parse(localStorage.getItem('auth')),
	    }).then(function successCallback(response) {
	        $rootScope.message = {
	            type : 'success',
	            data : "Sukses seting profil.",
	        }
			$location.path('/profile');
	    }, function errorCallback(response) {
	        $rootScope.message = {
	            type : 'danger',
	            data : response.data
	        }
	    });
    }
})
.controller('SettingPasswordController', function($scope, $rootScope, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'change-password';
	$rootScope.titlePage = 'Ubah Password';
	$rootScope.iconPage = 'fa-key';
	$rootScope.subtitleGroup = "";

    $scope.settingPassword = function () {
    	data = {
    		'last' 		: $scope.last,
    		'password' 	: $scope.password,
    	}
    	
    	if ($scope.password != $scope.repeat) {
	        $rootScope.message = {
	            type : 'danger',
	            data : "Pengulangan password salah."
	        }
    	}else{
			$http({
		        method : 'POST',
		        url : API + "setting/password",
		        data : data,
		        headers : JSON.parse(localStorage.getItem('auth')),
		    }).then(function successCallback(response) {
		        $rootScope.message = {
		            type : 'success',
		            data : "Sukses ubah password.",
		        }
				$location.path('/profile');
		    }, function errorCallback(response) {
		        $rootScope.message = {
		            type : 'danger',
		            data : response.data
		        }
		    });
    	}
    }
})
.controller('ActivityController', function($scope, $rootScope, $http){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.activeMenu = 'activity';
	$rootScope.titlePage = 'Aktifitas';
	$rootScope.iconPage = 'fa-tasks';
	$rootScope.titleMedia = false;
	$rootScope.subtitleGroup = "";

	data_user = JSON.parse(localStorage.getItem('auth'));

	$http({
        method : 'GET',
        url : API + "resep/user/" + data_user.userid,
    }).then(function successCallback(response) {
    	$rootScope.resep = response.data;
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    });
})
.controller('ResepUserController', function($scope, $rootScope, $routeParams, $location, $http){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = true;
	$rootScope.subtitleGroup = false;
	$http({
        method : 'GET',
        url : API + "user/" + $routeParams.id,
    }).then(function successCallback(response) {
		$rootScope.activeMenu = '';
		$rootScope.titlePage = response.data.nama;
		$rootScope.subtitleGroup = '@' + response.data.username + ' ' + response.data.jumlah_resep + " Resep";
		$rootScope.hideCategory = true;

		$http({
	        method : 'GET',
	        url : API + "resep/user/" + $routeParams.id,
	    }).then(function successCallback(response) {
	    	$rootScope.resep = response.data;
	    }, function errorCallback(response) {
	    	$rootScope.message = {
	    		type : 'danger',
	    		data : response.data,
	    	};
	    });
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    	$location.path('/beranda');
    });
})
.controller('ResepController', function($scope, $rootScope, $routeParams, $http){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.iconPage = '';
	$rootScope.subtitleGroup = false;
	
	$http({
        method : 'GET',
        url : API + "resep/" + $routeParams.id,
    }).then(function successCallback(response) {
		$rootScope.activeMenu = '';
		$rootScope.titlePage = response.data.nama_resep;

    	$rootScope.data = response.data;
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    	$location.path('/beranda');
    });
})
.controller('AddResepController', function($scope, $rootScope, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'activity';
	$rootScope.titlePage = 'Tambah Resep';
	$rootScope.iconPage = 'fa-plus-circle';

	$http({
        method : 'GET',
        url : API + "category",
    }).then(function successCallback(response) {
    	$scope.dataCategory = response.data;
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    });

    $scope.input = function () {
		new_data = {
    		'nama_resep' 	: $scope.nama_resep,
    		'kategori_id' 	: $scope.kategori_id,
    		'deskripsi' 	: $scope.deskripsi,
    		'bahan' 		: $scope.bahan,
    		'cara_membuat' 	: $scope.cara_membuat,
    		'gambar' 		: "",
		};

		$http({
	        method : 'POST',
	        url : API + "resep",
	        data : new_data, 
	        headers : JSON.parse(localStorage.getItem('auth')),
	    }).then(function successCallback(response) {
	    	$rootScope.message = {
	    		type : 'success',
	    		data : "Sukses tambah resep.",
	    	};
	    	$location.path('/activity');
	    }, function errorCallback(response) {
	    	$rootScope.message = {
	    		type : 'danger',
	    		data : response.data,
	    	};
	    });
    }
})
.controller('EditResepController', function($scope, $rootScope, $routeParams, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'activity';
	$rootScope.titlePage = 'Ubah Resep';
	$rootScope.iconPage = 'fa-pencil';
	$rootScope.subtitleGroup = "";

	$http({
        method : 'GET',
        url : API + "category",
    }).then(function successCallback(response) {
    	$scope.dataCategory = response.data;
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    });

	$http({
        method : 'GET',
        url : API + "resep/" + $routeParams.id,
    }).then(function successCallback(response) {
		$rootScope.activeMenu = '';
		$rootScope.titlePage = response.data.nama_resep;

    	$scope.nama_resep 	= response.data.nama_resep;
    	$scope.kategori_id 	= response.data.kategori_id;
    	$scope.deskripsi 	= response.data.deskripsi;
    	$scope.bahan 		= response.data.bahan;
    	$scope.cara_membuat = response.data.cara_membuat;
    }, function errorCallback(response) {
    	$rootScope.message = {
    		type : 'danger',
    		data : response.data,
    	};
    	$location.path('/beranda');
    });


    $scope.input = function () {
		new_data = {
    		'nama_resep' 	: $scope.nama_resep,
    		'kategori_id' 	: $scope.kategori_id,
    		'deskripsi' 	: $scope.deskripsi,
    		'bahan' 		: $scope.bahan,
    		'cara_membuat' 	: $scope.cara_membuat,
    		'gambar' 		: "",
		};

		$http({
	        method : 'PUT',
	        url : API + "resep/" + $routeParams.id,
	        data : new_data, 
	        headers : JSON.parse(localStorage.getItem('auth')),
	    }).then(function successCallback(response) {
	    	$rootScope.message = {
	    		type : 'success',
	    		data : "Sukses ubah resep.",
	    	};
	    	$location.path('/resep/' + $routeParams.id);
	    }, function errorCallback(response) {
	    	$rootScope.message = {
	    		type : 'danger',
	    		data : response.data,
	    	};
	    });
    }
})
.controller('DeleteResepController', function($scope, $rootScope, $routeParams, $http, $location){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'activity';
	$rootScope.titlePage = 'Delete Resep';
	$rootScope.iconPage = 'fa-trash';
	$rootScope.subtitleGroup = "";

    $scope.id = $routeParams.id;
    
    $scope.delete = function () {
		$http({
	        method : 'DELETE',
	        url : API + "resep/" + $scope.id,
	        headers : JSON.parse(localStorage.getItem('auth')),
	    }).then(function successCallback(response) {
	    	$rootScope.message = {
	    		type : 'success',
	    		data : "Sukses hapus resep.",
	    	};
	    	$location.path('/activity');
	    }, function errorCallback(response) {
	    	$rootScope.message = {
	    		type : 'danger',
	    		data : response.data,
	    	};
	    	$location.path('/activity');
	    });
    }
})
.controller('AboutController', function($scope, $rootScope){
	$rootScope.authData = JSON.parse(localStorage.getItem('auth'));
	$rootScope.titleMedia = false;
	$rootScope.activeMenu = 'about';
	$rootScope.titlePage = 'Tentang';
	$rootScope.iconPage = 'fa-info-circle';
	$rootScope.subtitleGroup = "";
});
