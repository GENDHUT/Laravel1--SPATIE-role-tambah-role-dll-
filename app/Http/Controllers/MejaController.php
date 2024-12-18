<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    // Method to display the tables
    

public function reserveTable($id)
{
    $meja = Meja::where('id', $id)
        ->where('status', 'tersedia')
        ->whereNull('user_id')
        ->first();

    if ($meja) {
        // Reserve the table for the user
        $meja->update([
            'status' => 'tiada',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Meja berhasil dipesan!');
    }

    return redirect()->route('dashboard')->with('error', 'Meja tidak tersedia.');
}

public function finishTable(Request $request, $id)
{
    $meja = Meja::find($id);
    $meja->status = 'tersedia';
    $meja->user_id = null;
    $meja->save();
    return redirect()->back()->with('success', 'Meja telah selesai');
}

public function addMultiple(Request $request)
{
    $nama_meja = $request->input('nama_meja');
    $jumlah_meja = $request->input('jumlah_meja');

    for ($i = 1; $i <= $jumlah_meja; $i++) {
        Meja::create([
            'nomor_meja' => $nama_meja . ' ' . $i,
            'status' => 'tersedia',
        ]);
    }

    return redirect()->back()->with('success', 'Meja telah ditambahkan');
}

public function addManual(Request $request)
{
    $nama_meja = $request->input('nama_meja');

    Meja::create([
        'nomor_meja' => $nama_meja,
        'status' => 'tersedia',
    ]);

    return redirect()->back()->with('status', 'meja-added');
}

public function hapus($id)
{
    Meja::find($id)->delete();
    return redirect()->back()->with('success', 'Meja telah dihapus');
}

public function edit(Meja $meja)
{
    return view('meja-edit', compact('meja'));
}

public function update(Request $request, Meja $meja)
{
    // Validasi input dari form
    $request->validate([
        'nomor_meja' => 'required|string|max:255',
        'status' => 'required|string|in:tersedia,dipesan',
    ]);

    // Update data meja
    $meja->update([
        'nomor_meja' => $request->input('nomor_meja'),
        'status' => $request->input('status'),
    ]);

    return redirect()->route('dashboard')->with('success', 'Meja berhasil diupdate.');
}

}
