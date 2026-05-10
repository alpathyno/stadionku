<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class PenontonController extends Controller
{
    public function index()
    {
        $penonton = User::where('role', 'user')
                        ->withCount('tikets')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('admin.penonton.index', compact('penonton'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/penonton')
            ->with('success', 'Akun penonton berhasil dihapus!');
    }
}