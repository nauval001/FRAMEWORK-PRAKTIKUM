<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik; // <-- Import Model Pemilik
use App\Models\User;    // <-- Import Model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;   // <-- Untuk Transaction
use Illuminate\Support\Facades\Hash; // <-- Untuk Hashing Password

class PemilikController extends Controller
{
    /**
     * Menampilkan daftar semua pemilik.
     * (Migrasi dari data_pemilik.php)
     */
    public function index()
    {
        // 'with('user')' adalah pengganti JOIN di Laravel (Eloquent)
        // Ini mengambil data pemilik beserta data user yang terelasi
        $pemilik = Pemilik::with('user')->get(); 
        return view('admin.pemilik.index', compact('pemilik'));
    }

    /**
     * Menampilkan form untuk membuat pemilik baru.
     * (Migrasi dari tambahpemilik)
     */
    public function create()
    {
        // Pastikan Anda membuat file view ini
        return view('admin.pemilik.create');
    }

    /**
     * Menyimpan pemilik baru ke database.
     * (Migrasi dari logika PHP di tambahpemilik)
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email', // Pastikan email unik di tabel user
            'password' => 'required|string|min:3', // Sesuaikan min password
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string',
        ]);

        // 2. Gunakan DB Transaction untuk memastikan data di 2 tabel (user & pemilik)
        // berhasil dibuat atau gagal bersamaan.
        DB::beginTransaction();
        try {
            // 3. Buat data User terlebih dahulu
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'idrole' => 3, // Asumsi '3' adalah ID role untuk Pemilik
            ]);

            // 4. Buat data Pemilik menggunakan ID user yang baru dibuat
            Pemilik::create([
                'iduser' => $user->iduser, // Ambil 'iduser' dari $user di atas
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

            // 5. Jika semua berhasil, simpan perubahan
            DB::commit();

            return redirect()->route('admin.pemilik.index')
                             ->with('success', 'Pemilik baru berhasil ditambahkan.');

        } catch (\Exception $e) {
            // 6. Jika terjadi error, batalkan semua perubahan
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form untuk mengedit data pemilik.
     * (Migrasi dari edit_pemilik.php)
     */
    public function edit($id)
    {
        // 'id' di sini adalah 'idpemilik'
        $pemilik = Pemilik::with('user')->findOrFail($id);
        
        // Pastikan Anda membuat file view ini
        return view('admin.pemilik.edit', compact('pemilik'));
    }

    /**
     * Update data pemilik di database.
     * (Migrasi dari logika PHP di edit_pemilik.php)
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi
        $request->validate([
            'nama' => 'required|string|max:100',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string',
            // Kita tidak validasi email/password di sini untuk menyederhanakan
        ]);

        DB::beginTransaction();
        try {
            // 2. Cari data pemilik
            $pemilik = Pemilik::findOrFail($id);

            // 3. Update data di tabel 'pemilik'
            $pemilik->update([
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);

            // 4. Update data nama di tabel 'user' yang terelasi
            $pemilik->user->update([
                'nama' => $request->nama,
            ]);

            DB::commit();

            return redirect()->route('admin.pemilik.index')
                             ->with('success', 'Data pemilik berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data pemilik dari database.
     * (Migrasi dari hapus_pemilik.php)
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // 1. Cari data pemilik
            $pemilik = Pemilik::findOrFail($id);
            $userId = $pemilik->iduser; // Simpan ID user sebelum dihapus

            // 2. Hapus data dari tabel 'pemilik'
            $pemilik->delete();

            // 3. Cari dan hapus data dari tabel 'user'
            $user = User::find($userId);
            if ($user) {
                $user->delete();
            }

            DB::commit();

            return redirect()->route('admin.pemilik.index')
                             ->with('success', 'Data pemilik berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}