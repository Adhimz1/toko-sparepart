<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk mengelola file

class SparepartController extends Controller
{
    /**
     * Menampilkan daftar semua sparepart.
     */
    public function index()
    {
        $spareparts = Sparepart::latest()->paginate(10);
        return view('admin.spareparts.index', compact('spareparts'));
    }

    /**
     * Menampilkan form untuk membuat sparepart baru.
     */
    public function create()
    {
        return view('admin.spareparts.create');
    }

    /**
     * Menyimpan sparepart baru ke database.
     */
    public function store(Request $request)
{
    // 1. Validasi input dari form
    $validatedData = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'harga' => 'required|integer|min:0',
        'stok' => 'required|integer|min:0',
        'deskripsi' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // 2. Handle upload gambar jika ada
    if ($request->hasFile('gambar')) {
        $path = $request->file('gambar')->store('public/spareparts');
        // Tambahkan path gambar ke data yang sudah divalidasi
        $validatedData['gambar'] = str_replace('public/', '', $path);
    }

    // 3. Simpan data yang bersih ke database
    Sparepart::create($validatedData);

    // 4. Redirect ke halaman index dengan pesan sukses
    return redirect()->route('admin.spareparts.index')
                     ->with('success', 'Sparepart berhasil ditambahkan.');
}


public function update(Request $request, Sparepart $sparepart)
{
    // 1. Validasi input
    $validatedData = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'harga' => 'required|integer|min:0',
        'stok' => 'required|integer|min:0',
        'deskripsi' => 'nullable|string',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // 2. Handle upload gambar baru jika ada
    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($sparepart->gambar && Storage::disk('public')->exists($sparepart->gambar)) {
            Storage::disk('public')->delete($sparepart->gambar);
        }
        // Simpan gambar baru
        $path = $request->file('gambar')->store('public/spareparts');
        $validatedData['gambar'] = str_replace('public/', '', $path);
    }

    // 3. Update data di database
    $sparepart->update($validatedData);

    // 4. Redirect ke halaman index dengan pesan sukses
    return redirect()->route('admin.spareparts.index')
                     ->with('success', 'Sparepart berhasil diperbarui.');
}
    public function destroy(Sparepart $sparepart)
    {
        // Hapus gambar dari storage jika ada
        if ($sparepart->gambar && Storage::disk('public')->exists($sparepart->gambar)) {
            Storage::disk('public')->delete($sparepart->gambar);
        }

        // Hapus data dari database
        $sparepart->delete();

        return redirect()->route('admin.spareparts.index')
                         ->with('success', 'Sparepart berhasil dihapus.');
    }
}