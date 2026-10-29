<?php
$route = []; 
 
// Route P2/P3 - dipertahankan. 
$route['default_controller'] = 'home'; 
$route['info/(:any)'] = 'home/info/$1'; 
$route['login'] = 'auth/login'; 
$route['auth/login'] = 'auth/login'; 
$route['auth/logout'] = 'auth/logout'; 
$route['admin'] = 'admin/index'; 
 
// P4: BARU - semua proses CRUD admin dipindahkan di bawah /admin/madmin. 
$route['admin/madmin'] = 'madmin_controller/index'; 
$route['admin/madmin/tambah'] = 'madmin_controller/tambah'; 
$route['admin/madmin/ubah/(:any)'] = 'madmin_controller/ubah/$1'; 
$route['admin/madmin/hapus/(:any)'] = 'madmin_controller/hapus/$1';


$route['admin/mobil'] = 'Mobil_controller/index';
$route['admin/mobil/tambah'] = 'Mobil_controller/tambah';
$route['admin/mobil/ubah/(:any)'] = 'Mobil_controller/ubah/$1';
$route['admin/mobil/hapus/(:any)'] = 'Mobil_controller/hapus/$1';


// Routes Pertemuan 6
// $route['default_controller'] = 'Home'; // dimatikan pada P6 karena penulisan index.php dihilangkan pada URL aplikasi
$route['default_controller'] = 'Katalog_controller';// karena penulisan index.php dihilangkan pada URL aplikasi
$route['katalog'] = 'Katalog_controller/index';
$route['katalog/detail/(:any)'] = 'Katalog_controller/detail/$1';
$route['auth/register'] = 'Auth/register';
$route['auth/login-penyewa'] = 'Auth/loginPenyewa';
$route['auth/logout-penyewa'] = 'Auth/logoutPenyewa';
$route['penyewa/profil'] = 'Penyewa_controller/profil';