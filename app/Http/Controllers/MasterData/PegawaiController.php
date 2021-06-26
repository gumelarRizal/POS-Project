<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterData\Pegawai;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titleBreadcrump = "Pegawai";
        $pegawai = Pegawai::orderBy('created_at', 'desc')->paginate(10);
        return view('MasterData.Pegawai.index', ['pegawai' => $pegawai, 'titleBreadcrump' => $titleBreadcrump]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('MasterData.Pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'id_pegawai' => 'required',
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required'
        ]);

        Pegawai::create($validasi);        
        return redirect()->route('Pegawai.index')->with('success', "Berhasil menambahkan data {$validasi['nama_pegawai']}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = Pegawai::find($id);
        return view('MasterData.Pegawai.edit', ['pegawai' => $pegawai]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required' 
        ]);

        Pegawai::where('id', $id)->update($validasi);
        return redirect()->route('Pegawai.index')->with('success', "Berhasil memperbaharui data {$validasi['nama_pegawai']}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pegawai::where('id', $id)->delete();
        return redirect()->route('Pegawai.index')->with('success', "Berhasil menghapus data");
    }

    public function search(Request $request){
        $pegawai = Pegawai::where('nama_pegawai', 'LIKE',"%".$request->cari."%")
                            ->orWhere('id_pegawai', 'LIKE', "%".$request->cari."%")
                            ->paginate(10);
        return view('MasterData.Pegawai.index', ['pegawai' => $pegawai]);
        
    }
}
