<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{MejaController, MenuController, MenuTransaksiController, TransaksiController, UserController};

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

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'active_user', 'verified'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/profile/{unique_id}', [UserController::class, 'show'])->name('user.profile');
        Route::get('/', [UserController::class, 'list'])->name('user.index');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/create', [UserController::class, 'store']);
        Route::get('/thrased', [UserController::class, 'thrased'])->name('user.thrased');
        Route::get('/password/edit', [UserController::class, 'editPassword'])->name('user.password.edit');
        Route::put('/password/update', [UserController::class, 'updatePassword'])->name('user.password.update');;
        Route::get('/info/edit', [UserController::class, 'editInfo'])->name('user.info.edit');
        Route::put('/info/update', [UserController::class, 'updateInfo'])->name('user.info.update');;
        Route::get('/avatar/edit', [UserController::class, 'editAvatar'])->name('user.avatar.edit');
        Route::put('/avatar/update', [UserController::class, 'updateAvatar'])->name('user.avatar.update');;
        Route::put('/deactivate', [UserController::class, 'deactivate'])->name('user.deactivate');;
        Route::put('/activate', [UserController::class, 'activate'])->name('user.activate');;
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('/', [MenuController::class, 'index'])->name('menu.index');
        Route::get('create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('create', [MenuController::class, 'store']);
        Route::get('{menu:slug}/show', [MenuController::class, 'show'])->name('menu.show');
        Route::get('{menu:slug}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('{menu:slug}/edit', [MenuController::class, 'update']);
        Route::delete('{menu:slug}/delete', [MenuController::class, 'destroy'])->name('menu.delete');

        Route::put('{id}/restore', [MenuController::class, 'restore'])->name('menu.restore');
        Route::get('thrased', [MenuController::class, 'thrased'])->name('menu.thrased');
        Route::get('thrased/{id}/show', [MenuController::class, 'showThrased'])->name('menu.thrased.show');
    });

    Route::group(['prefix' => 'meja'], function () {
        Route::get('/', [MejaController::class, 'index'])->name('meja.index');
        Route::get('create', [MejaController::class, 'create'])->name('meja.create');
        Route::post('create', [MejaController::class, 'store']);
        Route::get('{meja:id}/show', [MejaController::class, 'show'])->name('meja.show');
        Route::get('{meja:id}/edit', [MejaController::class, 'edit'])->name('meja.edit');
        Route::put('{meja:id}/edit', [MejaController::class, 'update']);
        Route::delete('{meja:id}/delete', [MejaController::class, 'destroy'])->name('meja.delete');

        Route::put('{id}/restore', [MejaController::class, 'restore'])->name('meja.restore');
        Route::get('thrased', [MejaController::class, 'thrased'])->name('meja.thrased');
        Route::get('thrased/{id}/show', [MejaController::class, 'showThrased'])->name('meja.thrased.show');
    });

    Route::group(['prefix' => 'meja'], function () {
        Route::get('show/list', [MejaController::class, 'showList'])->name('meja.show.list');
        Route::get('show/free', [MejaController::class, 'showFree'])->name('meja.show.free');
        Route::get('show/active', [MejaController::class, 'showActive'])->name('meja.show.active');
    });

    Route::group(['prefix' => 'transaksi'], function () {
        Route::post('create', [TransaksiController::class, 'store'])->name('transaksi.create');
        Route::get('menu/{transaksi:id}', [MenuTransaksiController::class, 'create'])->name('transaksi.menu.create');
        Route::get('menu/cart-counter/{transaksi:id}', [MenuTransaksiController::class, 'cartCounter'])->name('transaksi.menu.cart.counter');
        Route::post('menu/store', [MenuTransaksiController::class, 'store'])->name('transaksi.menu.store');
        Route::put('menu/edit/{transaksi:id}/{menu:id}', [MenuTransaksiController::class, 'update'])->name('transaksi.menu.update');
        Route::put('menu/delete/{transaksi:id}/{menu:id}', [MenuTransaksiController::class, 'destroy'])->name('transaksi.menu.delete');
        Route::get('menu/add/{menu:slug}', [MenuTransaksiController::class, 'showAdd'])->name('transaksi.menu.add');
        Route::get('menu/cart/{transaksi:id}', [MenuTransaksiController::class, 'showCart'])->name('transaksi.menu.cart');

        Route::get('detail/{transaksi:id}', [TransaksiController::class, 'detail'])->name('transaksi.detail');
        Route::put('bayar/{transaksi:id}', [TransaksiController::class, 'updateBayar'])->name('transaksi.bayar');;
        Route::put('batal/{transaksi:id}', [TransaksiController::class, 'batal'])->name('transaksi.batal');
        Route::get('invoice/{transaksi:id}/print', [TransaksiController::class, 'invoice'])->name('transaksi.invoice');

        Route::get('laporan/table', [TransaksiController::class, 'laporanTable'])->name('transaksi.laporan.table');
        Route::post('laporan/table/print', [TransaksiController::class, 'laporanTablePrint'])->name('transaksi.laporan.print');
        Route::get('laporan/chart', [TransaksiController::class, 'laporanChart'])->name('transaksi.laporan.chart');
    });
});
