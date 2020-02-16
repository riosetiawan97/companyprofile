<?php

namespace App\Http\Controllers;

use \App\Categories;
use \App\Posting;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Categories::all();
        return view('admin.kategori',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.add_kategori');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // validasi form
        $this->validate($request, [
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'flag_active' => 'required|string',
        ]);
        try {
         //Simpan data ke dalam table kategori
         $kategori = Categories::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'flag_active' => $request->flag_active
        ]);

        $posting = new Posting();

        $posting->kategori = $request->nama;
        $posting->isi = 'Tes Isi';
        $posting->create_by = 'admin';

        $posting->save();

        //jika berhasil direct ke produk.index
        return redirect(route('kategori.index'))
            ->with(['success' => '<strong>' . $kategori->nama . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $kategori = Categories::findOrFail($id);
        return view('admin.edit_kategori', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // validasi form
        $this->validate($request, [
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'flag_active' => 'required|string',
        ]);

        try {
            //query select berdasarkan id
            $kategori = Categories::findOrFail($id);

            //perbaharui data di database
            $kategori->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'flag_active' => $request->flag_active
            ]);

            return redirect(route('kategori.index'))
                ->with(['success' => '<strong>' . $kategori->nama . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $kategori = Categories::where('id', '=', $id)->firstOrFail();
        $posting = Posting::where('kategori', '=', $kategori->nama)->firstOrFail();

        
        //hapus data dari table
        $kategori->delete();
        $posting->delete();
        return redirect()->back()->with(['success' => '<strong>' . $kategori->nama . '</strong> Telah Dihapus!']);
    }
}
