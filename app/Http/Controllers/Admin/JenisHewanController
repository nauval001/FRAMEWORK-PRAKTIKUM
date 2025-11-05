<?php

// Pastikan namespace-nya benar
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan; // <-- Import Model
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    /**
     * Menampilkan daftar jenis hewan (LOGIKA DARI MODUL 9)
     * [cite: 251, 256, 257]
     */
    public function index()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    /**
     * Menampilkan form untuk membuat jenis hewan baru.
     * (Pengganti file native tambahjenis.php - bagian HTML)
     */
    public function create()
    {
        // Kita perlu membuat view ini
        return view('admin.jenis-hewan.create');
    }

    /**
     * Menyimpan jenis hewan baru ke database.
     * (Pengganti file native tambahjenis.php - bagian PHP)
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan',
        ]);

        // 2. Simpan data baru
        JenisHewan::create([
            'nama_jenis_hewan' => $request->nama_jenis_hewan,
        ]);

        // 3. Redirect kembali ke halaman index
        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Jenis hewan baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit jenis hewan.
     * (Pengganti file native edit_ras.php - bagian awal)
     */
    public function edit($id)
    {
        // Cari data berdasarkan Primary Key
        $jenisHewan = JenisHewan::findOrFail($id); 
        
        // Kita perlu membuat view ini
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    /**
     * Update data jenis hewan di database.
     * (Pengganti file native edit_ras.php - bagian PHP)
     */
    public function update(Request $request, $id)
    {
        // 1. Validasi data
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan,'.$id.',idjenis_hewan',
        ]);

        // 2. Cari data yang akan di-update
        $jenisHewan = JenisHewan::findOrFail($id);

        // 3. Update data
        $jenisHewan->update([
            'nama_jenis_hewan' => $request->nama_jenis_hewan,
        ]);

        // 4. Redirect kembali
        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Jenis hewan berhasil diperbarui.');
    }

    /**
     * Menghapus data jenis hewan.
     * (Pengganti file native hapus_ras.php)
     */
    public function destroy($id)
    {
        // 1. Cari data
        $jenisHewan = JenisHewan::findOrFail($id);
        
        // 2. Hapus data
        $jenisHewan->delete();

        // 3. Redirect kembali
        return redirect()->route('admin.jenis-hewan.index')
                         ->with('success', 'Jenis hewan berhasil dihapus.');
    }
}