<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbits = Penerbit::all();
        return view('admin.penerbit.index', compact('penerbits'));
    }

    public function create()
    {
        return view('admin.penerbit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_penerbit' => 'required|unique:tbl_penerbit,kode_penerbit|max:10',
            'nama_penerbit' => 'required|unique:tbl_penerbit,nama_penerbit|max:50',
            'alamat_penerbit' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'email' => 'required|email|max:30',
            'fax' => 'nullable|max:15',
            'website' => 'nullable|max:50',
            'kontak' => 'required|max:50'
        ]);

        Penerbit::create($request->all());
        return redirect()->route('admin.penerbit.index')->with('success', 'Penerbit berhasil ditambahkan');
    }

    public function edit(Penerbit $penerbit)
    {
        return view('admin.penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, Penerbit $penerbit)
    {
        $request->validate([
            'kode_penerbit' => 'required|unique:tbl_penerbit,kode_penerbit,'.$penerbit->id_penerbit.',id_penerbit|max:10',
            'nama_penerbit' => 'required|unique:tbl_penerbit,nama_penerbit,'.$penerbit->id_penerbit.',id_penerbit|max:50',
            'alamat_penerbit' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'email' => 'required|email|max:30',
            'fax' => 'nullable|max:15',
            'website' => 'nullable|max:50',
            'kontak' => 'required|max:50'
        ]);

        $penerbit->update($request->all());
        return redirect()->route('admin.penerbit.index')->with('success', 'Penerbit berhasil diperbarui');
    }

    public function destroy(Penerbit $penerbit)
    {
        $penerbit->delete();
        return redirect()->route('admin.penerbit.index')->with('success', 'Penerbit berhasil dihapus');
    }
}