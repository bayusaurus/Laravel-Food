<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{DetailUser, User, Role, Transaksi};
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;

class UserController extends Controller
{
    public function index()
    {
        $tanggal = Carbon::now('Asia/Jakarta')->toDateString();
        $transaksi = DB::table('transaksi')
            ->leftJoin('status_transaksi', 'transaksi.status_transaksi_id', 'status_transaksi.id')
            ->leftJoin('meja', 'transaksi.meja_id', 'meja.id')
            ->select('transaksi.*', 'status_transaksi.nama as status', 'meja.nama as meja')
            ->where('transaksi.created_at', 'LIKE', '%' . $tanggal . '%')
            ->get();
        $aktif = DB::table('transaksi')
            ->leftJoin('status_transaksi', 'transaksi.status_transaksi_id', 'status_transaksi.id')
            ->leftJoin('meja', 'transaksi.meja_id', 'meja.id')
            ->select('transaksi.*', 'status_transaksi.nama as status', 'meja.nama as meja')
            ->where('transaksi.created_at', 'LIKE', '%' . $tanggal . '%')
            ->where('transaksi.status_transaksi_id', '=', 1)
            ->get();
        $sukses = DB::table('transaksi')
            ->leftJoin('status_transaksi', 'transaksi.status_transaksi_id', 'status_transaksi.id')
            ->leftJoin('meja', 'transaksi.meja_id', 'meja.id')
            ->select('transaksi.*', 'status_transaksi.nama as status', 'meja.nama as meja')
            ->where('transaksi.created_at', 'LIKE', '%' . $tanggal . '%')
            ->where('transaksi.status_transaksi_id', '=', 2)
            ->get();
        $batal = DB::table('transaksi')
            ->leftJoin('status_transaksi', 'transaksi.status_transaksi_id', 'status_transaksi.id')
            ->leftJoin('meja', 'transaksi.meja_id', 'meja.id')
            ->select('transaksi.*', 'status_transaksi.nama as status', 'meja.nama as meja')
            ->where('transaksi.created_at', 'LIKE', '%' . $tanggal . '%')
            ->where('transaksi.status_transaksi_id', '=', 3)
            ->get();
        return view('users.dashboard', [
            'sidebarDashboard' => 1,
            'transaksis' => $transaksi,
            'aktif' => $aktif,
            'sukses' => $sukses,
            'batal' => $batal,
        ]);
    }
    public function show(Request $request)
    {
        $user = User::where('unique_id', $request->unique_id)->first();
        $user = User::find($user->id);
        return view('users.profile', ['user' => $user]);
    }
    public function create(Request $request)
    {
        return view('users.create_user', [
            'title' => 'Data User',
            'sidebarUser' => 1,
            'roles' => Role::get(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|regex:/^[\pL\s\-]+$/u|max:50',
            'telepon' => 'required|numeric|max:999999999999999',
            'alamat' => 'required|min:8|max:50',
            'foto' => 'required|mimetypes:image/png,image/jpg,image/jpeg|max:2000',
            'password' => 'required|min:8|max:50',
            'email' => 'required|email|unique:users|max:50',
            'role' => 'required',
        ]);

        $foto = date('mdYHis') . uniqid() . '.' . request()->file('foto')->extension();
        request()->file('foto')->move(public_path('images/user'), $foto);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'foto' => $foto,
            'password' => Hash::make($request->password),
            'unique_id' => date('mdYHis') . uniqid(),
            'role_id' => $request->role,
        ]);

        $user->detail()->create([
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
        ]);

        $user->sendEmailVerificationNotification();

        return redirect(route('user.index', Auth::user()->unique_id))->with('success', 'Pengguna Berhasil Ditambahkan');
    }
    public function list()
    {
        return view('users.list', [
            'title' => 'Data User',
            'sidebarUser' => 1,
            'users' => User::whereNull('deactivated_at')->get(),
        ]);
    }
    public function thrased()
    {
        return view('users.thrased', [
            'title' => 'Data User Terhapus',
            'sidebarUser' => 1,
            'users' => User::whereNotNull('deactivated_at')->get(),
        ]);
    }
    public function editPassword()
    {
        return view('users.edit_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old' => 'required',
            'new' => 'required|min:8',
        ]);

        $user = User::find(Auth::user()->id);

        if (Hash::check($request->old, $user->password)) {
            $user->password = bcrypt($request->new);
            $user->save();
            return redirect()->back()->with('success', 'Password sukses diubah');
        } else {
            return redirect()->back()->with('failed', 'Password lama salah');
        }
    }
    public function editInfo()
    {
        return view('users.edit_info', [
            'user' => User::find(Auth::user()->id),
            'sidebarUser' => 1
        ]);
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'nama' => 'required|regex:/^[\pL\s\-]+$/u',
            'telepon' => 'required|numeric|max:15',
            'alamat' => 'required|min:8|max:50',
        ]);

        $user = User::find(Auth::user()->id);

        $user->nama = $request->nama;
        $user->detail->telepon = $request->telepon;
        $user->detail->alamat = $request->alamat;

        $user->save();
        $user->detail->save();

        return redirect(route('user.profile', Auth::user()->unique_id))->with('success', 'Profile berhasil diubah');
    }
    public function editAvatar()
    {
        return view('users.edit_avatar', [
            'sidebarUser' => 1,
            'user' => User::find(Auth::user()->id)
        ]);
    }

    public function updateAvatar(Request $request)
    {
        // dd($request->file('foto'));
        $request->validate([
            'foto' => 'required|mimetypes:image/png,image/jpg,image/jpeg|max:2000',
        ]);

        $user = User::find(Auth::user()->id);

        $image_path = 'images/user/' . $user->foto;

        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $fotoName = date('mdYHis') . uniqid() . '.' . request()->file('foto')->extension();
        request()->file('foto')->move(public_path('images/user'), $fotoName);

        $user->foto = $fotoName;
        $user->save();

        return redirect(route('user.profile', Auth::user()->unique_id))->with('success', 'Foto berhasil diubah');
    }

    public function deactivate(Request $request)
    {
        $user = User::find($request->id);
        $user->deactivated_at = Carbon::now('Asia/Jakarta')->toDateTimeString();
        $user->save();
        return redirect(route('user.index'))->with('success', 'Pengguna berhasil dinonaktifkan');
    }

    public function activate(Request $request)
    {
        $user = User::find($request->id);
        $user->deactivated_at = null;
        $user->save();
        return redirect(route('user.index'))->with('success', 'Pengguna berhasil diaktifkan kembali');
    }
}
