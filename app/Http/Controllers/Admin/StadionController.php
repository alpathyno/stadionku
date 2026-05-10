<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stadion;
use Illuminate\Http\Request;

class StadionController extends Controller
{
    public function index()
    {
        $stadions = Stadion::withCount('pertandingan')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('admin.stadion.index', compact('stadions'));
    }

    public function create()
    {
        return view('admin.stadion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_stadion' => 'required|string|max:100',
            'kota'         => 'required|string|max:60',
            'kapasitas'    => 'required|integer|min:1',
            'alamat'       => 'required|string',
        ], [
            'nama_stadion.required' => 'Nama stadion wajib diisi.',
            'kota.required'         => 'Kota wajib diisi.',
            'kapasitas.required'    => 'Kapasitas wajib diisi.',
            'kapasitas.integer'     => 'Kapasitas harus berupa angka.',
            'kapasitas.min'         => 'Kapasitas minimal 1.',
            'alamat.required'       => 'Alamat wajib diisi.',
        ]);

        Stadion::create($request->all());

        return redirect('/admin/stadion')
            ->with('success', 'Stadion berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $stadion = Stadion::findOrFail($id);
        return view('admin.stadion.edit', compact('stadion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_stadion' => 'required|string|max:100',
            'kota'         => 'required|string|max:60',
            'kapasitas'    => 'required|integer|min:1',
            'alamat'       => 'required|string',
        ], [
            'nama_stadion.required' => 'Nama stadion wajib diisi.',
            'kota.required'         => 'Kota wajib diisi.',
            'kapasitas.required'    => 'Kapasitas wajib diisi.',
            'kapasitas.integer'     => 'Kapasitas harus berupa angka.',
            'kapasitas.min'         => 'Kapasitas minimal 1.',
            'alamat.required'       => 'Alamat wajib diisi.',
        ]);

        $stadion = Stadion::findOrFail($id);
        $stadion->update($request->all());

        return redirect('/admin/stadion')
            ->with('success', 'Stadion berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $stadion = Stadion::findOrFail($id);
        $stadion->delete();

        return redirect('/admin/stadion')
            ->with('success', 'Stadion berhasil dihapus!');
    }
}