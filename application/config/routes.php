<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*
| -------------------------------------------------------------------------
| CASE-SENSITIVE ROUTING FOR LINUX
| -------------------------------------------------------------------------
| Map lowercase URIs to properly-cased controller names for case-sensitive
| filesystems. This ensures CI can find controllers regardless of URI casing.
*/

// Main Controllers (mixed case names)
$route['export'] = 'Export';
$route['export/(:any)'] = 'Export/$1';

$route['forbidden'] = 'Forbidden';
$route['forbidden/(:any)'] = 'Forbidden/$1';

$route['kabps'] = 'Kabps';
$route['kabps/(:any)'] = 'Kabps/$1';

$route['kegiatan'] = 'Kegiatan';
$route['kegiatan/(:any)'] = 'Kegiatan/$1';

$route['kelola_nomor_surat'] = 'KelolaNomorSurat';
$route['kelola_nomor_surat/(:any)'] = 'KelolaNomorSurat/$1';

// Alias for kelolanomorsurat (used in some view files without underscores)
$route['kelolanomorsurat'] = 'KelolaNomorSurat';
$route['kelolanomorsurat/(:any)'] = 'KelolaNomorSurat/$1';

$route['kelola_no_sppd'] = 'Kelola_no_sppd';
$route['kelola_no_sppd/(:any)'] = 'Kelola_no_sppd/$1';

$route['kelola_no_surat'] = 'Kelola_no_surat';
$route['kelola_no_surat/(:any)'] = 'Kelola_no_surat/$1';

$route['laporan'] = 'Laporan';
$route['laporan/(:any)'] = 'Laporan/$1';

$route['main'] = 'Main';
$route['main/(:any)'] = 'Main/$1';

$route['master_aplikasi'] = 'Master_aplikasi';
$route['master_aplikasi/(:any)'] = 'Master_aplikasi/$1';

$route['master_data'] = 'Master_data';
$route['master_data/(:any)'] = 'Master_data/$1';

$route['matriks_kegiatan'] = 'Matriks_kegiatan';
$route['matriks_kegiatan/(:any)'] = 'Matriks_kegiatan/$1';

$route['pegawai'] = 'Pegawai';
$route['pegawai/(:any)'] = 'Pegawai/$1';

$route['persetujuan_ppk'] = 'Persetujuan_ppk';
$route['persetujuan_ppk/(:any)'] = 'Persetujuan_ppk/$1';

$route['presensi'] = 'Presensi';
$route['presensi/(:any)'] = 'Presensi/$1';

$route['spd'] = 'Spd';
$route['spd/(:any)'] = 'Spd/$1';

$route['surat_bayar'] = 'Surat_bayar';
$route['surat_bayar/(:any)'] = 'Surat_bayar/$1';

$route['user'] = 'User';
$route['user/(:any)'] = 'User/$1';

// API Controllers (subdirectory)
$route['api/absensi'] = 'api/Absensi';
$route['api/absensi/(:any)'] = 'api/Absensi/$1';

$route['api/main'] = 'api/Main';
$route['api/main/(:any)'] = 'api/Main/$1';

$route['api/olah_presensi'] = 'api/Olah_presensi';
$route['api/olah_presensi/(:any)'] = 'api/Olah_presensi/$1';
