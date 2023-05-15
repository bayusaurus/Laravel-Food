<?php

namespace App\Http\Controllers;

use App\Models\JenisMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadFile;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu.index', [
            'title' => 'Data Menu',
            'sidebarMenu' => 1,
            'menus' => Menu::get(),
        ]);
    }
    public function thrased()
    {
        return view('menu.thrased', [
            'title' => 'Data Menu Terhapus',
            'sidebarMenu' => 1,
            'menus' => Menu::onlyTrashed()->get(),
        ]);
    }
    public function show(Menu $menu)
    {
        return response()->json([
            'nama' => $menu->nama,
            'harga' => number_format($menu->harga, 0, ".", "."),
            'keterangan' => $menu->keterangan,
            'foto' => asset('images/menu/' . $menu->foto),
        ]);
    }
    public function showThrased($id)
    {
        $menu = Menu::onlyTrashed()->find($id);
        return response()->json([
            // 'html' => view('menu.show', ['menu' => $menu])->render(),
            'nama' => $menu->nama,
            'harga' => number_format($menu->harga, 0, ".", "."),
            'keterangan' => $menu->keterangan,
            'foto' => 'images/menu/' . $menu->foto,
        ]);
    }

    public function create()
    {
        return view('menu.create', [
            'title' => 'Create New Menu',
            'sidebarMenu' => 1,
            'jenisMenu' => JenisMenu::get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:50|unique:menu,nama',
            'jenisMenu' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg',
            'harga' => 'required|numeric|min:0|not_in:0',
            'keterangan' => 'required|max:255',
        ]);

        $fotoName = date('mdYHis') . uniqid() . '.' . request()->file('foto')->extension();
        $foto = request()->file('foto')->move(public_path('images/menu'), $fotoName);
        $menu = Menu::create([
            'nama' => request('nama'),
            'jenis_menu_id' => request('jenisMenu'),
            'slug' => Str::slug(request('nama')),
            'foto' => $fotoName,
            'harga' => request('harga'),
            'keterangan' => request('keterangan')
        ]);

        return redirect(route('menu.index'))->with('success', 'Menu sukses ditambahkan.');
    }

    public function edit(Menu $menu)
    {

        return view('menu.edit', [
            'title' => 'Edit Menu',
            'sidebarMenu' => 1,
            'menu' => $menu,
            'jenisMenu' => JenisMenu::get(),
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|max:50|unique:menu,nama,' . optional($menu)->id,
            'jenisMenu' => 'required',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg',
            'harga' => 'required|numeric|min:0|not_in:0',
            'keterangan' => 'required|max:255',
        ]);

        if (request('foto')) {
            $image_path = 'images/menu/' . $menu->foto;
            if (File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $fotoName = date('mdYHis') . uniqid() . '.' . request()->file('foto')->extension();
            $foto = request()->file('foto')->move(public_path('images/menu'), $fotoName);
        } elseif ($menu->foto) {
            $fotoName = $menu->foto;
        } else {
            $fotoName = null;
        }

        $menu->update([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama),
            'harga' => $request->harga,
            'foto' => $fotoName,
            'jenis_menu_id' => $request->jenisMenu,
            'keterangan' => $request->keterangan,
        ]);

        return redirect(route('menu.edit', $menu))->with('success', 'Menu sukses diubah.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return response()->json('Data sukses dihapus');
    }

    public function restore($id)
    {
        Menu::withTrashed()->find($id)->restore();
        return response()->json('Data sukses di restore');
    }
}
