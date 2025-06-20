<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Pastikan ini ada

class SparepartController extends Controller
{
    /**
     * Menampilkan daftar semua sparepart.
     * (INI METHOD YANG HILANG)
     */
    public function index()
    {
        $spareparts = Sparepart::latest()->paginate(10);
        return view('admin.spareparts.index', compact('spareparts'));
    }

    /**
     * Menampilkan form untuk membuat sparepart baru.
     * (INI METHOD YANG HILANG)
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
        // 1. Validasi input
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 2. Handle upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/img/spareparts');
            
            // Pastikan direktori ada, jika tidak, buat
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            
            $file->move($destinationPath, $fileName);
            $validatedData['gambar'] = 'spareparts/' . $fileName;
        }

        // 3. Simpan data ke database
        Sparepart::create($validatedData);

        return redirect()->route('admin.spareparts.index')
                         ->with('success', 'Sparepart berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit sparepart.
     */
    public function edit(Sparepart $sparepart)
    {
        return view('admin.spareparts.edit', compact('sparepart'));
    }

    /**
     * Mengupdate data sparepart di database.
     */
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
            if ($sparepart->gambar && File::exists(public_path('img/' . $sparepart->gambar))) {
                File::delete(public_path('img/' . $sparepart->gambar));
            }
            
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/img/spareparts');
            
            // Pastikan direktori ada, jika tidak, buat
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            $file->move($destinationPath, $fileName);
            $validatedData['gambar'] = 'spareparts/' . $fileName;
        }

        // 3. Update data di database
        $sparepart->update($validatedData);

        return redirect()->route('admin.spareparts.index')
                         ->with('success', 'Sparepart berhasil diperbarui.');
    }

    /**
     * Menghapus sparepart dari database.
     */
    public function destroy(Sparepart $sparepart)
    {
        // Hapus gambar dari folder public/img jika ada
        if ($sparepart->gambar && File::exists(public_path('img/' . $sparepart->gambar))) {
            File::delete(public_path('img/' . $sparepart->gambar));
        }

        $sparepart->delete();

        return redirect()->route('admin.spareparts.index')
                         ->with('success', 'Sparepart berhasil dihapus.');
    }
}