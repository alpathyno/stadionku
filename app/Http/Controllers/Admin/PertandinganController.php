<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pertandingan;
use App\Models\Stadion;
use Illuminate\Http\Request;

class PertandinganController extends Controller
{
    // List semua pertandingan
    public function index()
    {
        $pertandingan = Pertandingan::with('stadion')
                            ->orderBy('tanggal_pertandingan', 'desc')
                            ->paginate(10);

        return view('admin.pertandingan.index', compact('pertandingan'));
    }

    // Form tambah
    public function create()
    {
        $stadions = Stadion::all();
        return view('admin.pertandingan.create', compact('stadions'));
    }

    // Simpan data baru
    public function store(Request $request)
{

    $request->validate([
        'id_stadion'           => 'required|exists:stadion,id_stadion',
        'tim_tuan_rumah'       => 'required|string|max:80',
        'tim_tamu'             => 'required|string|max:80',
        'tanggal_pertandingan' => 'required|date',
        'jam_mulai'            => 'required',
        'status'               => 'required|in:Terjadwal,Dijual,Berlangsung,Selesai,Dibatalkan',
        'harga_min'            => 'required|numeric|min:0',
        'logo_tuan_rumah'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'logo_tamu'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->except(['logo_tuan_rumah', 'logo_tamu']);

    if ($request->hasFile('logo_tuan_rumah')) {
        $path = $request->file('logo_tuan_rumah')->store('logos', 'public');
        $data['logo_tuan_rumah'] = $path;
    }

    if ($request->hasFile('logo_tamu')) {
        $path = $request->file('logo_tamu')->store('logos', 'public');
        $data['logo_tamu'] = $path;
    }

    Pertandingan::create($data);

    return redirect('/admin/pertandingan')
        ->with('success', 'Pertandingan berhasil ditambahkan!');
}

    // Form edit
    public function edit($id)
    {
        $pertandingan = Pertandingan::findOrFail($id);
        $stadions     = Stadion::all();
        return view('admin.pertandingan.edit', compact('pertandingan', 'stadions'));
    }

    // Update data
    public function update(Request $request, $id)
{
    $request->validate([
        'id_stadion'           => 'required|exists:stadion,id_stadion',
        'tim_tuan_rumah'       => 'required|string|max:80',
        'tim_tamu'             => 'required|string|max:80',
        'tanggal_pertandingan' => 'required|date',
        'jam_mulai'            => 'required',
        'status'               => 'required|in:Terjadwal,Dijual,Berlangsung,Selesai,Dibatalkan',
        'harga_min'            => 'required|numeric|min:0',
        'logo_tuan_rumah'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'logo_tamu'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $pertandingan = Pertandingan::findOrFail($id);
    $data = $request->except(['logo_tuan_rumah', 'logo_tamu']);

    if ($request->hasFile('logo_tuan_rumah')) {
        // Hapus logo lama kalau ada
        if ($pertandingan->logo_tuan_rumah) {
            \Storage::disk('public')->delete($pertandingan->logo_tuan_rumah);
        }
        $data['logo_tuan_rumah'] = $request->file('logo_tuan_rumah')
                                    ->store('logos', 'public');
    }

    if ($request->hasFile('logo_tamu')) {
        if ($pertandingan->logo_tamu) {
            \Storage::disk('public')->delete($pertandingan->logo_tamu);
        }
        $data['logo_tamu'] = $request->file('logo_tamu')
                                ->store('logos', 'public');
    }

    $pertandingan->update($data);

    return redirect('/admin/pertandingan')
        ->with('success', 'Pertandingan berhasil diperbarui!');
}

    // Hapus data
    public function destroy($id)
    {
        $pertandingan = Pertandingan::findOrFail($id);
        $pertandingan->delete();

        return redirect('/admin/pertandingan')
            ->with('success', 'Pertandingan berhasil dihapus!');
    }
}