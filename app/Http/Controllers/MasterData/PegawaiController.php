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
        $pegawai = Pegawai::orderBy('created_at', 'desc')->paginate(10);
        return view('MasterData.Pegawai.index', ['pegawai' => $pegawai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titleBreadcrump = "Edit Pegawai";
        return view('MasterData.Pegawai.create', ['titleBreadcrump' => $titleBreadcrump]);
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

        if($request->has("id")){
            $result = Pegawai::where('id', $request->id)->update($request->except(['id_pegawai', '_token']));
            return Response()->json($result);
        }
        else{
            $result = Pegawai::create($validasi);
            return Response()->json($result);
        }
        
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
        $titleBreadcrump = "Edit Pegawai";
        return view('MasterData.Pegawai.edit', ['pegawai' => $pegawai, 'titleBreadcrump' => $titleBreadcrump]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateData(Request $request)
    {
        $validasi = $request->validate([
            'nama_pegawai' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required' 
        ]);

        $result = Pegawai::where('id', $request->id)->update($validasi);
        return Response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $id = $pegawai->id;
        Pegawai::where('id', $id)->delete();
        return redirect()->route('Pegawai.index')->with('success', "Berhasil menghapus data $pegawai->nama!");
    }

    public function search(Request $request){
        $pegawai = Pegawai::where('nama_pegawai', 'LIKE',"%".$request->cari."%")
                            ->orWhere('id_pegawai', 'LIKE', "%".$request->cari."%")
                            ->orderBy('created_at','desc')
                            ->paginate(10);
        $titleBreadcrump = "Pegawai";
        return view('MasterData.Pegawai.index', ['pegawai' => $pegawai, 'titleBreadcrump' => $titleBreadcrump]);
        
    }

    public function delete(Request $request){
        $id = $request->id;
        $result = Pegawai::where('id', $id)->delete();
        return response()->json($result);
    }

}
