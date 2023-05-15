<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Transaksi;
use Illuminate\Support\Str;
use Illuminate\Http\UploadFile;
use Illuminate\Support\Facades\File;

class MejaController extends Controller
{
    public function index()
    {
        return view('meja.index', [
            'title' => 'Data Meja',
            'sidebarMeja' => 1,
            'mejas' => Meja::orderBy('nama')->get(),
        ]);
    }
    public function thrased()
    {
        return view('meja.thrased', [
            'title' => 'Data Meja Terhapus',
            'sidebarMeja' => 1,
            'mejas' => Meja::onlyTrashed()->orderBy('nama')->get(),
        ]);
    }
    public function show(Meja $meja)
    {
        return response()->json([
            'nama' => $meja->nama,
            'kapasitas' => $meja->kapasitas,
            'sessionCode' => $meja->session_code,
            'foto' => 'images/meja/' . $meja->foto,
        ]);
    }
    public function showList()
    {
        return view('meja.list', [
            'title' => 'Daftar Meja',
            'all' => 1,
            'sidebarTransaksi' => 1,
            'mejas' => Meja::orderBy('nama')->get(),
        ]);
    }
    public function showFree()
    {
        return view('meja.list', [
            'title' => 'Daftar Meja Kosong',
            'free' => 1,
            'sidebarTransaksi' => 1,
            'mejas' => Meja::where('status_meja_id', 1)->orderBy('nama')->get(),
        ]);
    }
    public function showActive()
    {
        return view('meja.list', [
            'title' => 'Daftar Meja Aktif',
            'sidebarTransaksi' => 1,
            'aktif' => 1,
            'transaksis' => Transaksi::where('status_transaksi_id', 1)->orderBy('nama')->get(),
        ]);
    }
    public function showThrased($id)
    {
        $meja = Meja::onlyTrashed()->find($id);
        return response()->json([
            'nama' => $meja->nama,
            'kapasitas' => $meja->kapasitas,
            'sessionCode' => $meja->session_code,
            'foto' => 'images/meja/' . $meja->foto,
        ]);
    }

    public function create()
    {
        return view('meja.create', [
            'title' => 'Create New Meja',
            'sidebarMeja' => 1,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50|unique:meja,nama',
            'foto' => 'required|image|mimes:png,jpg,jpeg',
            'kapasitas' => 'required|numeric|min:0|not_in:0|max:20',

        ]);

        $fotoName = date('mdYHis') . uniqid() . '.' . request()->file('foto')->extension();
        $foto = request()->file('foto')->move(public_path('images/meja'), $fotoName);
        $meja = Meja::create([
            'nama' => request('nama'),
            'foto' => $fotoName,
            'status_meja_id' => 1,
            'session_code' => Str::upper(Str::random(6)),
            'kapasitas' => request('kapasitas')
        ]);

        return redirect(route('meja.index'))->with('success', 'Meja sukses ditambahkan.');
    }

    public function edit(Meja $meja)
    {

        return view('meja.edit', [
            'title' => 'Edit Meja',
            'sidebarMeja' => 1,
            'meja' => $meja,
        ]);
    }

    public function update(Request $request, Meja $meja)
    {
        $request->validate([
            'nama' => 'required|max:50|unique:meja,nama,' . optional($meja)->id,
            'foto' => 'nullable|image|mimes:png,jpg,jpeg',
            'kapasitas' => 'required|numeric|min:0|not_in:0|max:20',
        ]);

        if (request('foto')) {
            $image_path = 'images/meja/' . $meja->foto;
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $fotoName = date('mdYHis') . uniqid() . '.' . request()->file('foto')->extension();
            $foto = request()->file('foto')->move(public_path('images/meja'), $fotoName);
            $foto = $fotoName;
        } elseif ($meja->foto) {
            $foto = $meja->foto;
        } else {
            $foto = null;
        }

        $meja->update([
            'nama' => $request->nama,
            'kapasitas' => $request->kapasitas,
            'foto' => $foto,
        ]);

        return redirect(route('meja.edit', $meja))->with('success', 'Meja sukses diubah.');
    }

    public function destroy(Meja $meja)
    {
        if ($meja->statusMeja->nama !== 'KOSONG') {
            return response()->json([
                'status' => 'gagal',
                'message' => 'Data gagal dihapus karena masih digunakan',
            ]);
        } else {
            $meja->delete();
            return response()->json(['message' => 'Data sukses dihapus',]);
        }
    }

    public function restore($id)
    {
        Meja::withTrashed()->find($id)->restore();
        return response()->json('Data sukses di restore');
    }
}
