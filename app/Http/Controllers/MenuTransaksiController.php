<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class MenuTransaksiController extends Controller
{
    public function create(Transaksi $transaksi)
    {
        $cartCounter = DB::table('menu_transaksi')
            ->select(DB::raw('SUM(kuantitas) as kuantitas'))
            ->where('transaksi_id', '=', $transaksi->id)
            ->whereNull('deleted_at')
            ->first();
        $cartCounter->kuantitas == null ? $cartCounter->kuantitas = 0 : '';
        return view('transaksi.order', [
            'title' => 'Pesan Menu',
            'sidebarTransaksi' => 1,
            'transaksi' => $transaksi,
            'cartCounter' => $cartCounter->kuantitas,
            'main' => Menu::where('jenis_menu_id', 1)->orderBy('nama')->get(),
            'appetizer' => Menu::where('jenis_menu_id', 2)->orderBy('nama')->get(),
            'dessert' => Menu::where('jenis_menu_id', 3)->orderBy('nama')->get(),
            'drink' => Menu::where('jenis_menu_id', 4)->orderBy('nama')->get(),
            'other' => Menu::where('jenis_menu_id', 5)->orderBy('nama')->get(),
        ]);
    }
    public function cartCounter(Transaksi $transaksi)
    {
        $cartCounter = DB::table('menu_transaksi')
            ->select(DB::raw('SUM(kuantitas) as kuantitas'))
            ->where('transaksi_id', '=', $transaksi->id)
            ->whereNull('deleted_at')
            ->first();
        $cartCounter->kuantitas == null ? $cartCounter->kuantitas = 0 : '';
        return response()->json($cartCounter->kuantitas);
    }
    public function showAdd(Request $request, Menu $menu)
    {
        return response()->json([
            'html' => view('transaksi.modal.input', [
                'menu' => $menu,
                'transaksi' => $request->transaksi
            ])->render(),
        ]);
    }
    public function showCart(Transaksi $transaksi)
    {
        $total = DB::table('menu_transaksi')
            ->select(
                DB::raw('SUM(kuantitas) as kuantitas'),
                DB::raw('SUM(subtotal) as subtotal')
            )
            ->where('transaksi_id', '=', $transaksi->id)
            ->whereNull('deleted_at')
            ->first();
        $menuTransaksi = DB::table('menu_transaksi')
            ->select('menu_transaksi.*', 'menu.nama', 'menu.foto')
            ->where('transaksi_id', '=', $transaksi->id)
            ->join('menu', 'menu_id', 'menu.id')
            ->whereNull('menu_transaksi.deleted_at')
            ->get();
        return response()->json([
            'html' => view('transaksi.modal.cart', [
                'transaksi' => $transaksi,
                'menuTransaksi' => $menuTransaksi,
                'total' => $total,
            ])->render(),
        ]);
    }

    public function store(Request $request)
    {
        $trans = Transaksi::where('id', $request->transaksi)->first();
        if ($trans->status_transaksi_id !== 1) {
            return response()->json([
                'status' => 0,
                'message' => 'Menu gagal diupdate karena transaksi telah dibayar atau dibatalkan'
            ]);
        }
        $menuTransaksi = DB::table('menu_transaksi')
            ->where('menu_id', $request->menu)
            ->where('transaksi_id', $request->transaksi)
            ->get();

        $menu = Menu::find($request->menu);

        if ($menuTransaksi->count() > 0 && $menuTransaksi->first()->deleted_at == null) {
            //ADD ORDER TO EXISTING ORDER
            $menuTransaksi = $menuTransaksi->first();
            DB::table('menu_transaksi')
                ->where('menu_id', $request->menu)
                ->where('transaksi_id', $request->transaksi)
                ->update([
                    'kuantitas' => $menuTransaksi->kuantitas + $request->kuantitas,
                    'subtotal' => $menuTransaksi->subtotal + ($request->kuantitas * $menuTransaksi->harga),
                    'updated_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                ]);
            // return 'updated';
        } elseif ($menuTransaksi->count() > 0 && $menuTransaksi->first()->deleted_at !== null) {
            //NEW ORDER FROM DELETED ORDER
            $menuTransaksi = $menuTransaksi->first();
            DB::table('menu_transaksi')
                ->where('menu_id', $request->menu)
                ->where('transaksi_id', $request->transaksi)
                ->update([
                    'user_id' => Auth::user()->id,
                    'harga' => $menu->harga,
                    'kuantitas' => $request->kuantitas,
                    'subtotal' => $menu->harga * $request->kuantitas,
                    'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                    'updated_at' => null,
                    'deleted_at' => null,
                ]);
            // return "deleted";
        } else {
            //NEW ORDER
            DB::table('menu_transaksi')->insert([
                'menu_id' => $request->menu,
                'transaksi_id' => $request->transaksi,
                'user_id' => Auth::user()->id,
                'harga' => $menu->harga,
                'kuantitas' => $request->kuantitas,
                'subtotal' => $menu->harga * $request->kuantitas,
                'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
            ]);
        }
        $cartCounter = DB::table('menu_transaksi')
            ->select(DB::raw('SUM(kuantitas) as kuantitas'))
            ->where('transaksi_id', '=', $request->transaksi)
            ->whereNull('deleted_at')
            ->first();

        return response()->json([
            'status' => 1,
            'message' => 'Order sukses ditambahkan',
            'cartCounter' => $cartCounter->kuantitas
        ]);
    }

    public function update(Request $request)
    {
        $trans = Transaksi::where('id', $request->transaksi)->first();
        if ($trans->status_transaksi_id !== 1) {
            return response()->json([
                'status' => 0,
                'message' => 'Menu gagal dihapus karena transaksi telah dibayar atau dibatalkan',
            ]);
        }
        DB::table('menu_transaksi')
            ->where('menu_id', $request->menu)
            ->where('transaksi_id', $request->transaksi)
            ->update([
                'user_id' => Auth::user()->id,
                'harga' => $request->harga,
                'kuantitas' => $request->kuantitas,
                'subtotal' => $request->harga * $request->kuantitas,
                'updated_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
                'deleted_at' => null,
            ]);
        return response()->json([
            'status' => 1,
            'message' => 'Menu sukses diupdate',
        ]);
    }

    public function destroy(Request $request)
    {
        $trans = Transaksi::where('id', $request->transaksi)->first();
        if ($trans->status_transaksi_id !== 1) {
            return response()->json([
                'status' => 0,
                'message' => 'Menu gagal dihapus karena transaksi telah dibayar atau dibatalkan'
            ]);
        }
        DB::table('menu_transaksi')
            ->where('menu_id', $request->menu)
            ->where('transaksi_id', $request->transaksi)
            ->update([
                'user_id' => Auth::user()->id,
                'deleted_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
            ]);
        return response()->json([
            'status' => 1,
            'message' => 'Menu sukses dihapus'
        ]);
    }
}
