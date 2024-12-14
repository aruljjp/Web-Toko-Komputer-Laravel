<?php

use Illuminate\Support\Facades\Route;
use Illuminate\support\Facades\Auth;
use App\Http\Controllers\HomeCtrl;
use App\Http\Controllers\AuthCtrl;
use App\Http\Controllers\BarangCtrl;
use App\Http\Controllers\DashboardCtrl;
use App\Http\Controllers\HomepageCtrl;
use App\Http\Controllers\KategoriCtrl;
use App\Http\Controllers\MobileCtrl;
use App\Http\Controllers\PelangganCtrl;
use App\Http\Controllers\RekananCtrl;
use App\Http\Controllers\UserCtrl;
use App\http\Controllers\PenjualanCtrl;
use App\http\Controllers\PembelianCtrl;
use App\http\Controllers\OrderCtrl;
use App\Http\Controllers\PembayaranCtrl;
use App\Http\Controllers\ProfileCtrl;
use App\Http\Controllers\WishlistCtrl;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomepageCtrl::class,'home']);
Route::get('/about',[HomepageCtrl::class,'about']);
Route::get('/error',[HomepageCtrl::class,'halaman_error']);
Route::get('/homepage',[HomepageCtrl::class,'home']);
Route::get('/profile',[HomepageCtrl::class,'profile']);
// Route::get('/produk',[HomepageCtrl::class,'produk']);
Route::get('/kategori2/handphone',[HomepageCtrl::class,'handphone']);
// Route::get('/homepage/cari',[HomepageCtrl::class,'home']);
Route::get('/homepage/search',[HomepageCtrl::class,'search']);
Route::get('/detail_barang/{id}',[HomepageCtrl::class,'detail_barang']);
Route::get('/detail_barang/hapus/{id}',[HomepageCtrl::class,'hapus_komen']);
Route::get('/detail_barang/like/{id}',[HomepageCtrl::class,"likekomen"]);
Route::post('/detail_barang/{barang}',[HomepageCtrl::class,"simpan_komentar"]);
Route::post('/detail_barang/simpan/{barang}',[HomepageCtrl::class,"balas_komentar"]);
Route::get('/home',[HomeCtrl::class,'index']);
Route::get('/dashboard',[DashboardCtrl::class,'index']);

/*Wishlist*/
Route::get('/homepage/{id}',[WishlistCtrl::class,"add_wishlist"]);
Route::get('/wishlist',[WishlistCtrl::class,'wishlist']);
Route::get('/wishlist/delete/{id}',[WishlistCtrl::class,"delete_wishlist"]);
Route::post('/homepage/simpan','WishlistCtrl@save_wishlist');
/*Barang*/
Route::get('/barang/frm_barang',[BarangCtrl::class,'index']);
Route::get('/barang/edit_barang/{id}',[BarangCtrl::class,'edit']);
Route::post('/barang/update/{barang}',[BarangCtrl::class,'update']);
Route::get('/barang/hapus/{barang}',[BarangCtrl::class,"destroy"]);
Route::get('/barang/create_barang',[BarangCtrl::class,'create']);
Route::post('/barang/frm_barang',[BarangCtrl::class,"store"]);
Route::get('/barang/frm_barang/cari',[BarangCtrl::class,'index']);

/*User*/
Route::get('/user/frm_user',[UserCtrl::class,'index']);
Route::get('/user/edit_user/{id}',[UserCtrl::class,'edit']);
Route::post('/user/update/{user}',[UserCtrl::class,'update']);
Route::get('/user/hapus/{user}',[UserCtrl::class,"destroy"]);
Route::get('/user/create_user',[UserCtrl::class,'create']);
Route::post('/user/index',[UserCtrl::class,"store"]);
Route::get('/user/password',[UserCtrl::class,'show_password']);
Route::post('/user/password',[UserCtrl::class,'ubah_password']);
Route::get('/status', [UserCtrl::class, 'userOnlineStatus']);


/*login*/
Route::get('/auth/login','AuthCtrl@form_login')->name('login');
Route::post('/login/check','AuthCtrl@process_login')->name('login/check');
Route::get('/register','AuthCtrl@show_signup_form')->name('register');
Route::post('/register/save','AuthCtrl@process_signup');
Route::get('/logout','AuthCtrl@logout')->name('logout');

/*Rekanan*/
Route::get('/rekanan/frm_rekanan',[RekananCtrl::class,'index']);
Route::get('/rekanan/edit_rekanan/{id}',[RekananCtrl::class,'edit']);
Route::post('/rekanan/update/{rekanan}',[RekananCtrl::class,'update']);
Route::get('/rekanan/hapus/{rekanan}',[RekananCtrl::class,"destroy"]);
Route::get('/rekanan/create_rekanan',[RekananCtrl::class,'create']);
Route::post('/rekanan/frm_rekanan',[RekananCtrl::class,"store"]);
Route::get('/rekanan/frm_rekanan/cari',[RekananCtrl::class,'index']);

/*Pelanggan*/
Route::get('/pelanggan/frm_pelanggan',[PelangganCtrl::class,'index']);
Route::get('/pelanggan/edit_pelanggan/{id}',[PelangganCtrl::class,'edit']);
Route::post('/pelanggan/update/{pelanggan}',[PelangganCtrl::class,'update']);
Route::get('/pelanggan/hapus/{pelanggan}',[PelangganCtrl::class,"destroy"]);
Route::get('/pelanggan/create_pelanggan',[PelangganCtrl::class,'create']);
Route::post('/pelanggan/frm_pelanggan',[PelangganCtrl::class,"store"]);
Route::get('/pelanggan/frm_pelanggan/cari',[PelangganCtrl::class,'index']);

/*Penjualan*/
Route::get('/penjualan/laporan',[PenjualanCtrl::class,'index']);
Route::get('/penjualan/delete/{id}',[PenjualanCtrl::class,"delete"]);
Route::get('/penjualan/frm_penjualan',[PenjualanCtrl::class,'create']);
Route::post('/penjualan/simpan',[PenjualanCtrl::class,"store"]);
Route::post('/penjualan/simpan/tampung','PenjualanCtrl@simpantampung');
Route::get('/penjualan/frm_penjualan/{id}',[PenjualanCtrl::class,'edit']);
Route::post('/penjualan/update/{laporan}',[PenjualanCtrl::class,'update']);
Route::post('/penjualan/tampung/get','PenjualanCtrl@get');
Route::get('/penjualan/hapus/{id}','PenjualanCtrl@deletetampung');
Route::get('/penjualan/cetak/{id}','PenjualanCtrl@cetaknota');
Route::get('/penjualan/nota',[PenjualanCtrl::class,'shownota']);
Route::get('/penjualan/cetak_laporan','PenjualanCtrl@cetaklaporan');

/*Pembelian*/
Route::get('/pembelian/laporan',[PembelianCtrl::class,'index']);
Route::get('/pembelian/delete/{id}',[PembelianCtrl::class,"delete"]);
Route::get('/pembelian/frm_pembelian',[PembelianCtrl::class,'create']);
Route::post('/pembelian/simpan',[PembelianCtrl::class,"store"]);
Route::post('/pembelian/simpan/tampung','PembelianCtrl@simpantampung');
Route::get('/pembelian/frm_pembelian/{id}',[PembelianCtrl::class,'edit']);
Route::post('/pembelian/update/{laporan}',[PembelianCtrl::class,'update']);
Route::post('/pembelian/tampung/get','PembelianCtrl@get');
Route::get('/pembelian/hapus/{id}','PembelianCtrl@deletetampung');
Route::get('/pembelian/cetak/{id}','PembelianCtrl@cetaknota');
Route::get('/pembelian/nota',[PembelianCtrl::class,'shownota']);
Route::get('/pembelian/cetak_laporan','PembelianCtrl@cetaklaporan');

/* Order */
Route::get('/order/frm_order',[OrderCtrl::class,'create_order']);
Route::post('/homepage',[OrderCtrl::class,"store_order"]);
Route::post('/homepage/{barang}','OrderCtrl@save_order');
Route::get('/order/hapus/{id}',[OrderCtrl::class,"delete"]);
Route::get('/order/status/{id}',[OrderCtrl::class,"status"]);
Route::get('/order/data_order',[OrderCtrl::class,'data_order']);
Route::get('/order/data_pesanan',[OrderCtrl::class,'data_pesanan']);
Route::get('/order/delete/{id}',[OrderCtrl::class,"hapus"]);
Route::get('/order/detail_pesanan',[OrderCtrl::class,'detail_pesanan']);

/* Kategori */
Route::get('/kategori/data_kategori',[KategoriCtrl::class,'form_kategori']);
Route::get('/kategori/hapus/{id}',[KategoriCtrl::class,"destroy"]);
Route::get('/kategori/create_kategori',[KategoriCtrl::class,'create']);
Route::post('/kategori/frm_kategori',[KategoriCtrl::class,"store"]);
Route::get('/kategori/data_barang/{id}',[KategoriCtrl::class,'form_barang']);

/* Profile */
Route::get('/profile-user/profile',[ProfileCtrl::class,"profile"]);
Route::post('/profile-user/save','ProfileCtrl@save_profile');
Route::post('/profile-user/profile',[ProfileCtrl::class,"save_reply"]);

/* Pembayaran */
Route::get('/pembayaran/pembayaran',[PembayaranCtrl::class,'pembayaran']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
