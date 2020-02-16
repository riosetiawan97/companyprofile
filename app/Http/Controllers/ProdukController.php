<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use File;
use Image;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $path;
    public $dimensions;

    public function __construct()
    {
        //DEFINISIKAN PATH
        //$this->path = storage_path('app/public/images');
        $this->path = public_path('upload/produk');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['245', '300', '500'];
    }

    public function index()
    {
        //        
        $produk = Produk::all();
        return view('admin.produk',compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.add_produk');
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
        //validasi form
        $this->validate($request, [
            'nama' => 'required|string',
            'deskripsi' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            //default $photo = null
            $photo = null;
            //jika terdapat file (Foto / Gambar) yang dikirim
            if ($request->hasFile('gambar')) {
                //maka menjalankan method saveFile()
                $photo = $this->saveFile($request->nama, $request->file('gambar'));
            }


            //Simpan data ke dalam table products
            $produk = Produk::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'gambar' => $photo
            ]);

            //jika berhasil direct ke produk.index
            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $produk->nama . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
            // File::delete($this->path .'/'. $photo);
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        //set path untuk menyimpan gambar
        //$path = public_path('uploads/product');

        //cek jika uploads/product bukan direktori / folder
        if (!File::isDirectory($this->path)) {
            //maka folder tersebut dibuat
            File::makeDirectory($this->path, 0777, true, true);
        }
        //simpan gambar yang diuplaod ke folrder uploads/produk
        Image::make($photo)->save($this->path . '/' . $images);
        //mengembalikan nama file yang ditampung divariable $images
        foreach ($this->dimensions as $row) {
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY 
            $canvas = Image::canvas($row, $row);
            //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY 
            //DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($photo)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });
			
            //CEK JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->path . '/' . $row)) {
                //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                File::makeDirectory($this->path . '/' . $row);
            }
        	
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            $canvas->save($this->path . '/' . $row . '/' . $images);
        }

        return $images;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $produk = Produk::findOrFail($id);
        return view('admin.edit_produk', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //validasi
        $this->validate($request, [
            'nama' => 'required|string',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            //query select berdasarkan id
            $produk = Produk::findOrFail($id);
            $photo = $produk->gambar;


            // cek jika ada file yang dikirim dari form
            if ($request->hasFile('gambar')) {
                //cek, jika photo tidak kosong maka file yang ada di folder uploads/product akan dihapus
                if(!empty($photo)){
                    File::delete($this->path .'/245/'. $photo);
                    File::delete($this->path .'/300/'. $photo);
                    File::delete($this->path .'/500/'. $photo);
                    File::delete($this->path .'/'. $photo);
                }else{
                    null;
                }
                // !empty($photo) ? File::delete($this->path .'/'. $photo) : null;
                //uploading file dengan menggunakan method saveFile() yg telah dibuat sebelumnya
                $photo = $this->saveFile($request->nama, $request->file('gambar'));
            }


            //perbaharui data di database
            $produk->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'gambar' => $photo
            ]);

            return redirect(route('produk.index'))
                ->with(['success' => '<strong>' . $produk->name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {            
            File::delete($this->path .'/245/'. $produk->gambar);
            File::delete($this->path .'/300/'. $produk->gambar);
            File::delete($this->path .'/500/'. $produk->gambar);
            File::delete($this->path .'/'. $photo);
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //query select berdasarkan id
        $produk = Produk::findOrFail($id);
        //mengecek, jika field photo tidak null / kosong
        if (!empty($produk->gambar)) {
            //file akan dihapus dari folder uploads/produk
            File::delete($this->path .'/245/'. $produk->gambar);
            File::delete($this->path .'/300/'. $produk->gambar);
            File::delete($this->path .'/500/'. $produk->gambar);
            File::delete($this->path .'/'. $produk->gambar);
        }
        //hapus data dari table
        $produk->delete();
        return redirect()->back()->with(['success' => '<strong>' . $produk->nama . '</strong> Telah Dihapus!']);
    }
}
