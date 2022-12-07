<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Kurir;
use App\Pengiriman;
use Illuminate\Http\Request;
use App\Transaksi;
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
// Route::get('/coba',function(){
//     return view('penjual.produkadd');
// });

Route::post('/midtrans/notification', 'MidtransController@payment_handling');
Route::get('/midtrans/a', 'MidtransController@a');

Route::get('/', function () {
    return redirect('/home');
    $client = new GuzzleHttp\Client();
    $request = new \GuzzleHttp\Psr7\Request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?origins=-8.848198553520579%2C121.6637660808329&destinations=-8.832836631765579%2C121.67777565447375&key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k');
    $promise = $client->sendAsync($request)->then(function ($response) {
        $result = json_decode($response->getBody());
        echo $result->rows[0]->elements[0]->distance->value;
        echo $result->rows[0]->elements[0]->distance->text;
    });
    $promise->wait();
});



Auth::routes();
//Home
Route::get('/home', 'HomeController@index')->name('home');

//Produk Detail
Route::get('/produkdetail/{id}', 'penjual\ProdukController@detail')->name('user.produkdetail');
//DetailToko
Route::get('/tokodetail/{id}', 'penjual\PenjualController@detailToko')->name('pembeli.tokodetail');

Route::group(['middleware' => ['auth', 'cektoko']], function () {
    //Penjual
    Route::get('/seller/dashboard', 'penjual\PenjualController@dashboard')->name('seller.dashboard');
    //Toko 
    Route::get('/seller/halamanupdatetoko', 'penjual\PenjualController@halamanUpdateToko')->name('seller.halamanupdatetoko');
    //Etalase Produk
    Route::get('/seller/etalase', 'penjual\EtalaseProdukController@index')->name('seller.etalaseindex');
    Route::post('/seller/etalase/store', 'penjual\EtalaseProdukController@store')->name('seller.etalasestore');
    Route::put('/seller/etalase/update/{id}', 'penjual\EtalaseProdukController@update')->name('seller.etalaseupdate');
    Route::delete('/seller/etalase/delete/{id}', 'penjual\EtalaseProdukController@delete')->name('seller.etalasedelete');
    //Produk
    Route::get('/seller/produk', 'penjual\ProdukController@index')->name('seller.produkindex');
    Route::get('/seller/produk/add', 'penjual\ProdukController@add')->name('seller.produkadd');
    Route::get('/seller/produk/edit/{id}', 'penjual\ProdukController@edit')->name('seller.produkedit');
    Route::post('/seller/produk/store', 'penjual\ProdukController@store')->name('seller.produkstore');
    Route::put('/seller/produk/update/{id}', 'penjual\ProdukController@update')->name('seller.produkupdate');
    Route::delete('/seller/produk/delete/{id}', 'penjual\ProdukController@delete')->name('seller.produkdelete');
    Route::delete('/seller/produkimage/delete/{idproduk}/{idgambar}', 'penjual\ProdukController@deleteGambarEdit')->name('seller.gambarprodukdelete');
    //Kurir
    Route::get('seller/kurir', 'penjual\KurirController@index')->name('seller.kuririndex');
    Route::post('seller/kurir/store', 'penjual\KurirController@store')->name('seller.kurirstore');
    Route::put('seller/kurir/update/{id}', 'penjual\KurirController@update')->name('seller.kurirupdate');
    Route::delete('seller/kurir/delete/{id}', 'penjual\KurirController@destroy')->name('seller.kurirdelete');
    //Transaksi
    Route::get('seller/transaksi', 'penjual\TransaksiController@index')->name('seller.transaksiindex');
    Route::get('seller/transaksi/{id}', 'penjual\TransaksiController@show')->name('seller.transaksishow');
    Route::get('seller/transaksi/status/{id}/{status}', 'penjual\TransaksiController@ubahstatus')->name('seller.transaksistatus');
    Route::post('seller/transaksi/notifpelanggan', 'penjual\TransaksiController@notifPesan')->name('seller.notifpesan');
    //Pengiriman
    Route::get('seller/pengiriman', 'penjual\PengirimanController@index')->name('seller.pengiriman');
    Route::get('seller/pengiriman/{id}', 'penjual\PengirimanController@show')->name('seller.pengirimandetail');
    Route::post('seller/plotkurir', 'penjual\PengirimanController@plotkurir')->name('seller.plotkurir');
    //Obrolan
    Route::get('/obrolan/seller/{idpembeli?}', 'ChatController@indexPenjual')->name('seller.obrolanindex');
    Route::get('obrolan/seller/data/get/{id}', 'ChatController@ambilDataPenjual')->name('seller.obrolanget');
    Route::post('/obrolan/seller/post', 'ChatController@storeDataPenjual')->name('seller.obrolanstore');
    //Voucher
    Route::get('voucher', 'penjual\VoucherController@index')->name('seller.voucherindex');
    Route::post('voucher/store', 'penjual\VoucherController@store')->name('seller.voucherstore');
    Route::put('voucher/update/{id}', 'penjual\VoucherController@edit')->name('seller.voucheredit');
    Route::delete('voucher/store/{id}', 'penjual\VoucherController@destroy')->name('seller.voucherdestroy');
    //Refund
    Route::get('seller/refund', 'RefundPencarianDanaController@indexPenjual')->name('seller.refund');
    Route::post('seller/refund/store', 'RefundPencarianDanaController@storePenjual')->name('seller.refundstore');
    Route::get('seller/refund/{id}', 'RefundPencarianDanaController@detail')->name('seller.refunddetail');
});
Route::group(['middleware' => ['auth']], function () {
    //Toko
    Route::post('/seller/updatetoko', 'penjual\PenjualController@updateToko')->name('seller.updatetoko');
    Route::post('/seller/storetoko', 'penjual\PenjualController@storeToko')->name('seller.storetoko');
    Route::get('/seller/registoko', 'penjual\PenjualController@regisToko')->name('seller.registoko');
    //Keranjang
    Route::get('/keranjang', 'pembeli\KeranjangController@index')->name('user.keranjang');
    Route::get('/keranjang/notif', 'pembeli\KeranjangController@keranjangNotif')->name('user.keranjangnotif');
    Route::post('/keranjang/store', 'pembeli\KeranjangController@store')->name('user.keranjangstore');
    Route::put('/keranjang/update/{id}', 'pembeli\KeranjangController@updateKeranjang')->name('user.keranjangupdte');
    Route::delete('/keranjang/delete/{id}', 'pembeli\KeranjangController@destroy')->name('user.keranjangdestroy');
    //Wishlist
    Route::get('/wishlist', 'pembeli\WishlistController@index')->name('user.wishlist');
    Route::get('/wishlist/store/{id}', 'pembeli\WishlistController@store')->name('user.wishliststore');
    Route::get('/wishlist/storekeranjang/{id}', 'pembeli\WishlistController@addToCart')->name('user.wishlistaddToCart');
    Route::get('/wishlist/destroy/{id}', 'pembeli\WishlistController@destroy')->name('user.wishlistdestroy');
    //Alamat
    Route::get('/alamat', 'pembeli\AlamatController@index')->name('user.alamat');
    Route::post('/alamat/store', 'pembeli\AlamatController@store')->name('user.alamatstore');
    Route::get('/alamat/edit/{id}', 'pembeli\AlamatController@edit')->name('user.alamatedit');
    Route::put('/alamat/update/{id}', 'pembeli\AlamatController@update')->name('user.alamatupdate');
    Route::delete('/alamat/edit/{id}', 'pembeli\AlamatController@destroy')->name('user.alamatdelete');
    Route::get('/alamat/utama/{id}','pembeli\AlamatController@jadikanUtama')->name('user.alamatutama');
    //Transaksi
    Route::get('/transaksi', 'pembeli\TransaksiController@index')->name('user.transaksi');
    Route::post('/transaksi/store', 'pembeli\TransaksiController@store')->name('user.transaksistore');
    Route::get('transaksi/ajaxdetail/{id}', 'pembeli\TransaksiController@ambildataajax');
    Route::get('/tokenmidtrans/{id}', 'pembeli\TransaksiController@ambiltokenmidtrans');
    Route::get('transaksi/status/{id}/{status}', 'pembeli\TransaksiController@ubahstatus')->name('user.transaksiubahstatus');
    Route::get('transaksi/datareview/{id}', 'pembeli\TransaksiController@ambildatareview')->name('user.transaksiambildatareview');
    Route::post('transaksi/datareview/store/{id}', 'pembeli\TransaksiController@storereview')->name('user.transaksistoredatareview');
    //Obrolan
    Route::get('/obrolan/{idpenjual?}', 'ChatController@indexPembeli')->name('pembeli.obrolanindex');
    Route::get('obrolan/data/get/{id}', 'ChatController@ambilDataPembeli')->name('pembeli.obrolanget');
    Route::post('/obrolan/post', 'ChatController@storeDataPembeli')->name('pembeli.obrolanstore');
    Route::post('/obrolan2/post', 'ChatController@storeDataPembeliDetailProduk')->name('pembeli.obrolanstore2');
    //Voucher
    Route::post('voucher/check', 'penjual\VoucherController@checkVoucher')->name('pembeli.checkvoucher');
    //Refund
    Route::get('refund', 'RefundPencarianDanaController@indexPembeli')->name('pembeli.refund');
    Route::post('refund/store', 'RefundPencarianDanaController@storePembeli')->name('pembeli.refundstore');
    Route::get('refund/{id}', 'RefundPencarianDanaController@detail')->name('pembeli.refunddetail');
    // Search
    Route::get('/search', 'pembeli\SearchController@index');
});

//ADMIN

Route::get('admin/login', 'admin\AdminController@login')->name('admin.login');
Route::get('admin/logout', 'admin\AdminController@logout')->name('admin.logout');
Route::post('admin/loginproses', 'admin\AdminController@loginproses')->name('admin.loginproses');
Route::get('admin/refund', 'admin\AdminController@refund')->name('admin.refund');
Route::get('admin/pencairan', 'admin\AdminController@pencairan')->name('admin.pencairan');
Route::get('admin/onkir', 'admin\AdminController@onkir')->name('admin.onkir');
Route::post('admin/onkir/post', 'admin\AdminController@setOnkir')->name('admin.onkirpost');
Route::get('admin/acc/{id}', 'admin\AdminController@acc')->name('admin.acc');
Route::get('admin', 'admin\AdminController@index')->name('admin.index');
Route::get('admin/refund', 'admin\AdminController@refund')->name('admin.refund');
Route::get('admin/pencairan', 'admin\AdminController@pencairan')->name('admin.pencairan');
Route::get('admin/onkir', 'admin\AdminController@onkir')->name('admin.onkir');
Route::post('admin/onkir/post', 'admin\AdminController@setOnkir')->name('admin.onkirpost');
Route::get('admin/acc/{id}','admin\AdminController@acc')->name('admin.acc');

Route::get('/midtrans', 'pembeli\TransaksiController@index')->name('coba');
Route::get('ambillokasi', 'penjual\PenjualController@ambilLokasi')->name('ambillokasi');
Route::get('cobapeta', function () {
    return view('pembeli.lokasitoko');
});

Route::get('/loginkurir', function (Request $request) {
    if ($request->session()->has('kurir')) {
        return redirect('kurir/home');
    } else {
        return view('kurir.login');
    }
});
Route::post('loginproseskurir', function (Request $request) {
    try {
        $kurir = Kurir::where('email', $request->get('email'))->where('password', $request->get('password'))->first();
        if (!$kurir) {
            return 'username password salah';
        } else {
            $request->session()->put('kurir', $kurir->idkurir);
            return redirect('kurir/home');
        }
    } catch (\Exception $e) {
        return $e->getMessage();
    }
})->name('loginproseskurir');
Route::get('kurir/home', function (Request $request) {
    if ($request->session()->has('kurir')) {
        $data = Pengiriman::where('kurir_idkurir', $request->session()->get('kurir'))->get();
        // return $data;
        return view('kurir.daftarpengiriman', compact('data'));
    } else {
        return view('kurir.login');
    }
})->name('kurir.home');
Route::get('kurir/detail/{id}', function (Request $request, $id) {
    if ($request->session()->has('kurir')) {
        $databarang = Transaksi::join('detail_transaksi', 'detail_transaksi.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
            ->join('produk', 'produk.idproduk', '=', 'detail_transaksi.produk_idproduk')
            ->join('pengiriman', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->where('pengiriman.idpengiriman', $id)
            ->select('detail_transaksi.*', 'produk.nama')
            ->get();
        $dataalamat = Transaksi::join('alamat', 'alamat.idalamat', '=', 'transaksi.alamat_idalamat')
            ->join('provinsi', 'provinsi.idprovinsi', '=', 'alamat.provinsi_idprovinsi')
            ->join('kotakabupaten', 'kotakabupaten.idkotakabupaten', 'alamat.kotakabupaten_idkotakabupaten')
            ->join('pengiriman', 'transaksi.idtransaksi', '=', 'pengiriman.transaksi_idtransaksi')
            ->where('pengiriman.idpengiriman', $id)
            ->select('alamat.*', 'kotakabupaten.nama as kabupaten', 'provinsi.nama as provinsi')
            ->first();
        $datapengiriman = Pengiriman::where('idpengiriman', $id)->first();
        return view('kurir.detailpengiriman', compact('dataalamat', 'databarang', 'datapengiriman'));
    } else {
        return view('kurir.login');
    }
})->name('kurirdetail');
Route::get('kurir/logout', function (Request $request) {
    if ($request->session()->has('kurir')) {
        $request->session()->forget('kurir');
    } else {
        return view('kurir.login');
    }
});
Route::get('kurir/status/{id}/{status}', function ($id, $status) {
    try {
        if ($status == "Antar Sekarang") {
            $pengiriman = Pengiriman::find($id);
            $pengiriman->status = "Pesanan Diantar";
            $pengiriman->save();
        } else if ($status == "Sampai Tujuan") {
            $pengiriman = Pengiriman::find($id);
            $pengiriman->status = $status;
            $pengiriman->save();
            $transaksi = Transaksi::find($pengiriman->transaksi_idtransaksi);
            $transaksi->status = $status;
            $transaksi->save();
        }
        return redirect()->back()->with('sukses', 'Berhasil ubah status pengiriman');
    } catch (\Exception $e) {
        return redirect()->back()->with('gagal', $e->getMessage());
    }
})->name('kurir.status');

