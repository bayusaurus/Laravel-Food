<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;

class TransaksiController extends Controller
{

    public function store(Request $request)
    {

        $date = Carbon::now('Asia/Jakarta')->toDateString();
        $transaksi = Transaksi::where('created_at', 'LIKE', '%' . $date . '%')->latest()->get();

        if ($transaksi->count() > 0) {
            $transaksi = $transaksi->first();
            $noOrder = $transaksi->no_order + 1;
        } else {
            $noOrder = 1;
        }
        $faktur = date("d/m/y") . '/' . str_pad($noOrder, 4, "0", STR_PAD_LEFT);
        $meja = Meja::find($request->meja);
        if ($meja->status_meja_id == 1) {
            $meja->update(['status_meja_id' => 2]);
            $transaksi = Transaksi::create([
                'meja_id' => $request->meja,
                'status_transaksi_id' => 1,
                'nama' => $request->nama,
                'no_order' => $noOrder,
                'meja_id' => $request->meja,
                'faktur' => $faktur,
                'created_at' => Carbon::now('Asia/Jakarta')->toDateTimeString(),
            ]);
            return redirect(route('transaksi.menu.create', $transaksi));
        } else {
            return redirect()->back()->with('failed', 'Gagal menambahkan transaksi karena meja sedang digunakan');
        }
    }

    public function detail(Transaksi $transaksi)
    {
        return view('transaksi.bayar', [
            'title' => 'Pembayaran Transaksi',
            'sidebarTransaksi' => 1,
            'transaksi' => $transaksi,
            'total' => DB::table('menu_transaksi')
                ->select(
                    DB::raw('SUM(kuantitas) as kuantitas'),
                    DB::raw('SUM(subtotal) as subtotal')
                )
                ->where('transaksi_id', '=', $transaksi->id)
                ->whereNull('deleted_at')
                ->first(),
            'menus' => DB::table('menu_transaksi')
                ->select('menu_transaksi.*', 'menu.nama', 'menu.foto')
                ->where('transaksi_id', '=', $transaksi->id)
                ->join('menu', 'menu_id', 'menu.id')
                ->whereNull('menu_transaksi.deleted_at')
                ->get(),
        ]);
    }

    public function updateBayar(Request $request, Transaksi $transaksi)
    {
        $transaksi->update([
            'user_id' => Auth::user()->id,
            'status_transaksi_id' => 2,
            'total_bayar' => $request->total,
        ]);

        $meja = Meja::find($transaksi->meja_id);
        $meja->update([
            'status_meja_id' => 1,
            'session_code' => Str::upper(Str::random(6)),
        ]);

        return redirect()->back()->with('success', 'Transaksi Telah Dibayar');
    }
    public function batal(Transaksi $transaksi)
    {
        $transaksi->update([
            'user_id' => Auth::user()->id,
            'status_transaksi_id' => 3,
        ]);

        $meja = Meja::find($transaksi->meja_id);
        $meja->update([
            'status_meja_id' => 1,
            'session_code' => Str::upper(Str::random(6)),
        ]);

        return redirect()->back()->with('failed', 'Transaksi Telah Dibatalkan');
    }

    public function invoice(Transaksi $transaksi)
    {

        $menu = DB::table('menu_transaksi')
            ->select('menu_transaksi.*', 'menu.nama')
            ->where('transaksi_id', '=', $transaksi->id)
            ->join('menu', 'menu_id', 'menu.id')
            ->whereNull('menu_transaksi.deleted_at')
            ->get();
        //KEMUDIAN MENGGUNAKAN PENGATURAN LANDSCAPE A4
        $pdf = PDF::loadView('transaksi.invoice', [
            'menu' => $menu,
            'transaksi' => $transaksi,
        ])->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    public function laporanTable(Request $request)
    {
        if (!empty($request->input('start_date')) && !empty($request->input('end_date'))) {
            $request->validate([
                'start_date' => 'required',
                'end_date' => 'required'
            ]);
            $transaksi = DB::table('transaksi')
                ->leftJoin('status_transaksi', 'transaksi.status_transaksi_id', 'status_transaksi.id')
                ->leftJoin('meja', 'transaksi.meja_id', 'meja.id')
                ->select('transaksi.*', 'status_transaksi.nama as status', 'meja.nama as meja')
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->get();
            $omset = DB::table('transaksi')
                ->select(DB::raw('SUM(total_bayar) as total'))
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->first();
            $sukses = DB::table('transaksi')
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->where('status_transaksi_id', '=', 2)
                ->count();
            $batal = DB::table('transaksi')
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->where('status_transaksi_id', '=', 3)
                ->count();
            $date = Carbon::now('Asia/Jakarta')->format('F Y');
            $title = 'Laporan Transaksi ' . date('d F Y', strtotime($request->start_date)) . " - " . date('d F Y', strtotime($request->end_date));
            return view('transaksi.laporan.table', [
                'sidebarLaporan' => 1,
                'sukses' => $sukses,
                'batal' => $batal,
                'omset' => $omset,
                'transaksis' => $transaksi,
                'title' => $title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
        } else {
            $transaksi = DB::table('transaksi')
                ->leftJoin('status_transaksi', 'transaksi.status_transaksi_id', 'status_transaksi.id')
                ->leftJoin('meja', 'transaksi.meja_id', 'meja.id')
                ->select('transaksi.*', 'status_transaksi.nama as status', 'meja.nama as meja')
                ->where('transaksi.created_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->get();
            $omset = DB::table('transaksi')
                ->select(DB::raw('SUM(total_bayar) as total'))
                ->where('created_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->first();
            $sukses = DB::table('transaksi')
                ->where('created_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->where('status_transaksi_id', '=', 2)
                ->count();
            $batal = DB::table('transaksi')
                ->where('created_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->where('status_transaksi_id', '=', 3)
                ->count();
            $title = 'Laporan Transaksi 30 Hari Terakhir';
            return view('transaksi.laporan.table', [
                'sidebarLaporan' => 1,
                'sukses' => $sukses,
                'batal' => $batal,
                'omset' => $omset,
                'transaksis' => $transaksi,
                'title' => $title,
            ]);
        }
    }

    public function laporanChart(Request $request)
    {
        if (!empty($request->input('start_date')) && !empty($request->input('end_date'))) {
            $performaPelayan = DB::table('menu_transaksi')
                ->join('users', 'user_id', 'users.id')
                ->select(
                    'users.nama as nama',
                    DB::raw('COUNT(menu_transaksi.user_id) as total_transaksi'),
                    DB::raw('SUM(menu_transaksi.kuantitas) as total_kuantitas'),
                    DB::raw('SUM(menu_transaksi.subtotal) as total_harga')
                )
                ->whereNull('menu_transaksi.deleted_at')
                ->whereBetween('menu_transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->groupBy('menu_transaksi.user_id')
                ->get();

            if (count($performaPelayan) > 0) {
                foreach ($performaPelayan as $data) {
                    $namaPelayan[] = $data->nama;
                    $transaksiPelayan[] = $data->total_transaksi;
                    $kuantitasPelayan[] = $data->total_kuantitas;
                    $hargaPelayan[] = $data->total_harga;
                }
            } else {
                $namaPelayan[] = null;
                $transaksiPelayan[] = null;
                $kuantitasPelayan[] = null;
                $hargaPelayan[] = null;
            }
            $performaKasir = DB::table('transaksi')
                ->join('users', 'user_id', 'users.id')
                ->select(
                    'users.nama as nama',
                    DB::raw('COUNT(transaksi.id) as total_transaksi'),
                    DB::raw('SUM(total_bayar) as total_bayar'),
                )
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->whereIn('transaksi.status_transaksi_id',  [2, 3])
                ->groupBy('transaksi.user_id')
                ->orderBy('nama')
                ->get();
            $performaKasirSukses = DB::table('transaksi')
                ->join('users', 'user_id', 'users.id')
                ->select(
                    'users.nama as nama',
                    DB::raw('COUNT(transaksi.id) as sukses'),
                )
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->where('transaksi.status_transaksi_id',  2)
                ->groupBy('transaksi.user_id')
                ->orderBy('nama')
                ->get();
            $performaKasirBatal = DB::table('transaksi')
                ->leftJoin('users', 'user_id', 'users.id')
                ->select(
                    'users.nama as nama',
                    DB::raw('COUNT(transaksi.id) as batal'),
                )
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->where('transaksi.status_transaksi_id',  3)
                ->where('users.role_id',  3)
                ->groupBy('transaksi.user_id')
                ->orderBy('nama')
                ->get();
            if (count($performaKasir) > 0) {
                foreach ($performaKasir as $data) {
                    $namaKasir[] = $data->nama;
                    $transaksiKasir[] = $data->total_transaksi;
                    $transaksiKasirHarga[] = $data->total_bayar;
                }
                foreach ($performaKasirSukses as $data) {
                    $transaksiKasirSuksesNama[$data->nama] = $data->sukses;
                }
                $transaksiKasirSukses = [];
                foreach ($namaKasir as $data) {
                    if (isset($transaksiKasirSuksesNama[$data])) {
                        $transaksiKasirSukses[] = $transaksiKasirSuksesNama[$data];
                    } else {
                        $transaksiKasirSukses[] = 0;
                    }
                }

                foreach ($performaKasirBatal as $data) {
                    $transaksiKasirBatalNama[$data->nama] = $data->batal;
                }
                $transaksiKasirBatal = [];
                foreach ($namaKasir as $data) {
                    if (isset($transaksiKasirBatalNama[$data])) {
                        $transaksiKasirBatal[] = $transaksiKasirBatalNama[$data];
                    } else {
                        $transaksiKasirBatal[] = 0;
                    }
                }
            } else {
                $namaKasir[] = null;
                $transaksiKasir[] = null;
                $transaksiKasirHarga[] = null;
                $transaksiKasirSukses[] = null;
                $transaksiKasirBatal[] = null;
            }
            // $berdasarHari = DB::table('transaksi')
            //     ->select([
            //         DB::raw('COUNT(id) as total_transaksi'),
            //         DB::raw('DAYNAME(created_at) as dayname')
            //     ])
            //     ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
            //     ->groupBy('dayname')
            //     ->orderByRaw("FIELD(dayname,'Monday','Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday')")
            //     ->get();
                $transaksiHariNama[] = null;
                $transaksiHariTotal[] = null;
            // if (count($berdasarHari) > 0) {
            //     foreach ($berdasarHari as $data) {
            //         $transaksiHariNama[] = $data->dayname;
            //         $transaksiHariTotal[] = $data->total_transaksi;
            //     }
            // } else {
                
            // }
            $berdasarTanggal = DB::table('transaksi')
                ->select([
                    DB::raw('COUNT(id) as total_transaksi'),
                    DB::raw('DATE(created_at) as date')
                ])
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->groupBy('date')
                ->get();
            if (count($berdasarTanggal) > 0) {
                foreach ($berdasarTanggal as $data) {
                    $transaksiTanggalNama[] = $data->date;
                    $transaksiTanggalTotal[] = $data->total_transaksi;
                }
            } else {
                $transaksiTanggalNama[] = null;
                $transaksiTanggalTotal[] = null;
            }

            $transaksiSukses = DB::table('transaksi')
                ->select([
                    DB::raw('COUNT(id) as total_transaksi')
                ])
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->where('transaksi.status_transaksi_id', 2)
                ->count();
            $transaksiGagal = DB::table('transaksi')
                ->select([
                    DB::raw('COUNT(id) as total_transaksi')
                ])
                ->whereBetween('transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->where('transaksi.status_transaksi_id', 3)
                ->count();
            $menu = DB::table('menu_transaksi')
                ->join('menu', 'menu_id', 'menu.id')
                ->select(
                    'menu.nama as nama',
                    // DB::raw('COUNT(menu_transaksi.menu_id) as total_transaksi'),
                    DB::raw('SUM(menu_transaksi.kuantitas) as total_kuantitas'),
                    DB::raw('SUM(menu_transaksi.subtotal) as total_harga')
                )
                ->whereNull('menu_transaksi.deleted_at')
                ->whereBetween('menu_transaksi.created_at',  [$request->start_date . ' 00:00:01', $request->end_date . ' 23:59:59'])
                ->groupBy('menu_transaksi.menu_id')
                ->orderBy('total_kuantitas', 'DESC')
                ->get();
            if (count($menu) > 0) {
                foreach ($menu as $data) {
                    $transaksiMenuNama[] = $data->nama;
                    $transaksiMenuKuantitas[] = $data->total_kuantitas;
                    $transaksiMenuHarga[] = $data->total_harga;
                }
            } else {
                $transaksiMenuNama[] = null;
                $transaksiMenuKuantitas[] = null;
                $transaksiMenuHarga[] = null;
            }

            $title = 'Statistik Transaksi ' . date('d F Y', strtotime($request->start_date)) . " - " . date('d F Y', strtotime($request->end_date));

            return view('transaksi.laporan.chart', [
                'sidebarStatistik' => 1,
                'title' => $title,
                'namaPelayan' => json_encode($namaPelayan),
                'transaksiPelayan' => json_encode($transaksiPelayan),
                'kuantitasPelayan' => json_encode($kuantitasPelayan),
                'hargaPelayan' => json_encode($hargaPelayan),
                'transaksiHariNama' => json_encode($transaksiHariNama),
                'transaksiHariTotal' => json_encode($transaksiHariTotal),
                'transaksiTanggalNama' => json_encode($transaksiTanggalNama),
                'transaksiTanggalTotal' => json_encode($transaksiTanggalTotal),
                'transaksiSukses' => json_encode($transaksiSukses),
                'transaksiGagal' => json_encode($transaksiGagal),
                'namaKasir' => json_encode($namaKasir),
                'transaksiKasir' => json_encode($transaksiKasir),
                'transaksiKasirSukses' => json_encode($transaksiKasirSukses),
                'transaksiKasirBatal' => json_encode($transaksiKasirBatal),
                'transaksiKasirHarga' => json_encode($transaksiKasirHarga),
                'transaksiMenuNama' => json_encode($transaksiMenuNama),
                'transaksiMenuKuantitas' => json_encode($transaksiMenuKuantitas),
                'transaksiMenuHarga' => json_encode($transaksiMenuHarga),
            ]);
        } else {
            $performaPelayan = DB::table('menu_transaksi')
                ->join('users', 'user_id', 'users.id')
                ->select(
                    'users.nama as nama',
                    DB::raw('COUNT(menu_transaksi.user_id) as total_transaksi'),
                    DB::raw('SUM(menu_transaksi.kuantitas) as total_kuantitas'),
                    DB::raw('SUM(menu_transaksi.subtotal) as total_harga')
                )
                ->whereNull('menu_transaksi.deleted_at')
                ->where('menu_transaksi.created_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->groupBy('menu_transaksi.user_id', 'users.nama')
                ->get();
            if (count($performaPelayan) > 0) {
                foreach ($performaPelayan as $data) {
                    $namaPelayan[] = $data->nama;
                    $transaksiPelayan[] = $data->total_transaksi;
                    $kuantitasPelayan[] = $data->total_kuantitas;
                    $hargaPelayan[] = $data->total_harga;
                }
            } else {
                $namaPelayan[] = null;
                $transaksiPelayan[] = null;
                $kuantitasPelayan[] = null;
                $hargaPelayan[] = null;
            }
            $performaKasir = DB::table('transaksi')
                ->join('users', 'user_id', 'users.id')
                ->select(
                    'users.nama as nama',
                    DB::raw('COUNT(transaksi.id) as total_transaksi'),
                    DB::raw('SUM(total_bayar) as total_bayar'),
                )
                ->where('transaksi.updated_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->whereIn('transaksi.status_transaksi_id',  [2, 3])
                ->groupBy('transaksi.user_id', 'users.nama')
                ->orderBy('nama')
                ->get();
            $performaKasirSukses = DB::table('transaksi')
                ->join('users', 'user_id', 'users.id')
                ->select(
                    'users.nama as nama',
                    DB::raw('COUNT(transaksi.id) as sukses'),
                )
                ->where('transaksi.updated_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->where('transaksi.status_transaksi_id',  2)
                ->groupBy('transaksi.user_id', 'users.nama')
                ->orderBy('nama')
                ->get();
            $performaKasirBatal = DB::table('transaksi')
                ->leftJoin('users', 'user_id', 'users.id')
                ->select(
                    'users.nama as nama',
                    DB::raw('COUNT(transaksi.id) as batal'),
                )
                ->where('transaksi.updated_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->where('transaksi.status_transaksi_id',  3)
                ->where('users.role_id',  3)
                ->groupBy('transaksi.user_id', 'users.nama')
                ->orderBy('nama')
                ->get();
            if (count($performaKasir) > 0) {
                foreach ($performaKasir as $data) {
                    $namaKasir[] = $data->nama;
                    $transaksiKasir[] = $data->total_transaksi;
                    $transaksiKasirHarga[] = $data->total_bayar;
                }
                foreach ($performaKasirSukses as $data) {
                    $transaksiKasirSuksesNama[$data->nama] = $data->sukses;
                }
                $transaksiKasirSukses = [];
                foreach ($namaKasir as $data) {
                    if (isset($transaksiKasirSuksesNama[$data])) {
                        $transaksiKasirSukses[] = $transaksiKasirSuksesNama[$data];
                    } else {
                        $transaksiKasirSukses[] = 0;
                    }
                }

                foreach ($performaKasirBatal as $data) {
                    $transaksiKasirBatalNama[$data->nama] = $data->batal;
                }
                $transaksiKasirBatal = [];
                foreach ($namaKasir as $data) {
                    if (isset($transaksiKasirBatalNama[$data])) {
                        $transaksiKasirBatal[] = $transaksiKasirBatalNama[$data];
                    } else {
                        $transaksiKasirBatal[] = 0;
                    }
                }
            } else {
                $namaKasir[] = null;
                $transaksiKasir[] = null;
                $transaksiKasirHarga[] = null;
                $transaksiKasirSukses[] = null;
                $transaksiKasirBatal[] = null;
            }

            // $berdasarHari = DB::table('transaksi')
            //     ->select([
            //         DB::raw('COUNT(id) as total_transaksi'),
            //         DB::raw('DAYNAME(created_at) as dayname')
            //     ])
            //     ->where('transaksi.updated_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
            //     ->groupBy('dayname')
            //     ->orderByRaw("FIELD(dayname,'Monday','Tuesday', 'Wednesday','Thursday','Friday','Saturday','Sunday')")
            //     ->get();
                $transaksiHariNama[] = null;
                $transaksiHariTotal[] = null;
            // if (count($berdasarHari) > 0) {
            //     foreach ($berdasarHari as $data) {
            //         $transaksiHariNama[] = $data->dayname;
            //         $transaksiHariTotal[] = $data->total_transaksi;
            //     }
            // } else {
                
            // }
            $berdasarTanggal = DB::table('transaksi')
                ->select([
                    DB::raw('COUNT(id) as total_transaksi'),
                    DB::raw('DATE(created_at) as date')
                ])
                ->where('transaksi.updated_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->groupBy('date')
                ->get();
            if (count($berdasarTanggal) > 0) {
                foreach ($berdasarTanggal as $data) {
                    $transaksiTanggalNama[] = $data->date;
                    $transaksiTanggalTotal[] = $data->total_transaksi;
                }
            } else {
                $transaksiTanggalNama[] = null;
                $transaksiTanggalTotal[] = null;
            }
            $transaksiSukses = DB::table('transaksi')
                ->select([
                    DB::raw('COUNT(id) as total_transaksi')
                ])
                ->where('transaksi.updated_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->where('transaksi.status_transaksi_id', 2)
                ->count();
            $transaksiGagal = DB::table('transaksi')
                ->select([
                    DB::raw('COUNT(id) as total_transaksi')
                ])
                ->where('transaksi.updated_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->where('transaksi.status_transaksi_id', 3)
                ->count();
            $menu = DB::table('menu_transaksi')
                ->join('menu', 'menu_id', 'menu.id')
                ->select(
                    'menu.nama as nama',
                    // DB::raw('COUNT(menu_transaksi.menu_id) as total_transaksi'),
                    DB::raw('SUM(menu_transaksi.kuantitas) as total_kuantitas'),
                    DB::raw('SUM(menu_transaksi.subtotal) as total_harga')
                )
                ->whereNull('menu_transaksi.deleted_at')
                ->where('menu_transaksi.created_at', '>=', Carbon::now('Asia/Jakarta')->subDays(30))
                ->groupBy('menu_transaksi.menu_id', 'menu.nama')
                ->orderBy('total_kuantitas', 'DESC')
                ->get();
            if (count($menu) > 0) {
                foreach ($menu as $data) {
                    $transaksiMenuNama[] = $data->nama;
                    $transaksiMenuKuantitas[] = $data->total_kuantitas;
                    $transaksiMenuHarga[] = $data->total_harga;
                }
            } else {
                $transaksiMenuNama[] = null;
                $transaksiMenuKuantitas[] = null;
                $transaksiMenuHarga[] = null;
            }
            return view('transaksi.laporan.chart', [
                'sidebarStatistik' => 1,
                'title' => 'Statistik 30 Hari Terakhir',
                'namaPelayan' => json_encode($namaPelayan),
                'transaksiPelayan' => json_encode($transaksiPelayan),
                'kuantitasPelayan' => json_encode($kuantitasPelayan),
                'hargaPelayan' => json_encode($hargaPelayan),
                'transaksiHariNama' => json_encode($transaksiHariNama),
                'transaksiHariTotal' => json_encode($transaksiHariTotal),
                'transaksiTanggalNama' => json_encode($transaksiTanggalNama),
                'transaksiTanggalTotal' => json_encode($transaksiTanggalTotal),
                'transaksiSukses' => json_encode($transaksiSukses),
                'transaksiGagal' => json_encode($transaksiGagal),
                'namaKasir' => json_encode($namaKasir),
                'transaksiKasir' => json_encode($transaksiKasir),
                'transaksiKasirSukses' => json_encode($transaksiKasirSukses),
                'transaksiKasirBatal' => json_encode($transaksiKasirBatal),
                'transaksiKasirHarga' => json_encode($transaksiKasirHarga),
                'transaksiMenuNama' => json_encode($transaksiMenuNama),
                'transaksiMenuKuantitas' => json_encode($transaksiMenuKuantitas),
                'transaksiMenuHarga' => json_encode($transaksiMenuHarga),
            ]);
        }
    }

    public function laporanTablePrint(Request $request)
    {
        if (!empty($request->start) && !empty($request->end)) {
            $request->validate([
                'start' => 'required',
                'end' => 'required'
            ]);
            $transaksi = DB::table('transaksi')
                ->leftJoin('status_transaksi', 'transaksi.status_transaksi_id', 'status_transaksi.id')
                ->leftJoin('meja', 'transaksi.meja_id', 'meja.id')
                ->select('transaksi.*', 'status_transaksi.nama as status', 'meja.nama as meja')
                ->whereBetween('transaksi.created_at',  [$request->start . ' 00:00:01', $request->end . ' 23:59:59'])
                ->get();
            $omset = DB::table('transaksi')
                ->select(DB::raw('SUM(total_bayar) as total'))
                ->whereBetween('transaksi.created_at',  [$request->start . ' 00:00:01', $request->end . ' 23:59:59'])
                ->first();
            $date = Carbon::now('Asia/Jakarta')->format('F Y');
            $title = 'Laporan Transaksi ' . date('d F Y', strtotime($request->start)) . " - " . date('d F Y', strtotime($request->end));
            $pdf = PDF::loadView('transaksi.laporan.print', [
                'omset' => $omset,
                'transaksis' => $transaksi,
                'title' => $title,
                'start_date' => $request->start,
                'end_date' => $request->end,
            ])->setPaper('a4', 'portrait');
            return $pdf->stream();
        } else {
            $transaksi = DB::table('transaksi')
                ->leftJoin('status_transaksi', 'transaksi.status_transaksi_id', 'status_transaksi.id')
                ->leftJoin('meja', 'transaksi.meja_id', 'meja.id')
                ->select('transaksi.*', 'status_transaksi.nama as status', 'meja.nama as meja')
                ->where('transaksi.created_at', '>=', Carbon::now()->startOfMonth())
                ->get();
            $omset = DB::table('transaksi')
                ->select(DB::raw('SUM(total_bayar) as total'))
                ->where('created_at', '>=', Carbon::now()->startOfMonth())
                ->first();
            $date = Carbon::now('Asia/Jakarta')->format('F Y');
            $title = 'Laporan Transaksi ' . $date;
            $pdf = PDF::loadView('transaksi.laporan.print', [
                'omset' => $omset,
                'transaksis' => $transaksi,
                'title' => $title,
            ])->setPaper('a4', 'portrait');
            return $pdf->stream();
        }
    }
}
