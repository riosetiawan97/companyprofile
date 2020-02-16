<?php

namespace App\Http\Controllers;

use \App\Posting;
use \App\Categories;
use Illuminate\Http\Request;

class PostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.posting');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kategori)
    {
        //
        $posting = Posting::where('kategori', '=', $kategori)->firstOrFail();
        $kategori = Categories::where('nama', '=', $kategori)->firstOrFail();        
        return view('admin.posting', compact('posting', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kategori)
    {
        //
        $this->validate($request, [
            'posting' => 'required|string',
        ]);

        try {
            //query select berdasarkan id
            $posting = Posting::where('kategori', '=', $kategori)->firstOrFail();

            //perbaharui data di database
            $posting->update([
                'isi' => $request->posting
            ]);

            return redirect()->intended('/admin')
                ->with(['success' => '<strong>' . $posting->kategori . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        // return redirect()->intended('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
