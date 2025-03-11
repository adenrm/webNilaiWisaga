<?php

namespace App\Http\Controllers;

use App\Models\Value; // Pastikan untuk menggunakan model yang sesuai
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'value_dt1' => 'required|numeric',
            'value_dt2' => 'required|numeric',
            'value_mss' => 'required|numeric',
        ]);

        // Temukan nilai berdasarkan ID
        $value = Value::findOrFail($id);

        // Perbarui nilai
        $value->value_dt1 = $request->input('value_dt1');
        $value->value_dt2 = $request->input('value_dt2');
        $value->value_mss = $request->input('value_mss');
        $value->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Nilai berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Temukan nilai berdasarkan ID
        $value = Value::findOrFail($id);

        // Hapus nilai
        $value->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Nilai berhasil dihapus.');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'value_dt1' => 'required|numeric',
            'value_dt2' => 'required|numeric',
            'value_mss' => 'required|numeric',
        ]);

        // Mendapatkan admin yang sedang masuk
        $admin = Auth::guard('admin')->user();
        $study = $admin->studys->first(); // Mengambil study pertama

        if (!$study) {
            return redirect()->back()->with('error', 'Admin tidak memiliki study yang terkait.');
        }

        // Mengatur study_id ke id dari study yang ada di admin
        $study_id = $study->id;

        // Membuat nilai baru
        $value = new Value();
        $value->user_id = $request->input('user_id');
        $value->studys_id = $study_id; // Mengatur study_id
        $value->study = $study->name; // Mengatur nama study secara otomatis dari study admin
        $value->value_dt1 = $request->input('value_dt1');
        $value->value_dt2 = $request->input('value_dt2');
        $value->value_mss = $request->input('value_mss');
        $value->save();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Nilai berhasil ditambahkan.');
    }

    // Tambahkan metode lain sesuai kebutuhan, seperti index, create, store, dll.
} 