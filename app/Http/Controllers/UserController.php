<?php

namespace App\Http\Controllers;

use App\Models\Surat;

use App\Helpers\Storage;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        return view ('user.isUser');
    }

    public function uploadSurat()
    {
        return view('user.uploadSurat');
    }

    public function postUpload(Request $req)
    {
        $name=$req->input('name');
        $perihal=$req->input('perihal');
        $file=$req->file('file');
        if( empty($file))
        {
            return back()->with('failed','File Tidak Ada');
        }
        $uploadDokumen= Storage::uploadSurat($file);

        $data= new Surat();
        $data->name=$name;
        $data->perihal=$perihal;
        $data->file=$uploadDokumen;
        $data->nama_pengirim=auth()->user()->cabang;
        $data->kategori="Cabang";
        $data->users_id=auth()->user()->id;
        $data->status="Belum di Proses";
        $data->id_penerima="Pusat";
        $data->level=1;
       

        // dd($data);
        $data->save();

        return redirect()->route('uploadSurat')->with('success', 'Surat Berhasil di Kirim!!!');     
    }



    public function pengajuanSurat()
    {
        $id=auth()->user()->id;
        $data=Surat::select('surat.id','surat.name','users.cabang','surat.kategori','surat.id_penerima','surat.perihal','surat.kategori','surat.status','surat.file','surat.created_at as tanggal_surat','surat.keterangan_validasi','users.name as nama_pengirim')->where('surat.users_id','=',$id)->join('users','surat.users_id','=','users.id')->orderBy('surat.created_at','desc')->simplePaginate(10);
        // dd($data);
        return view ('user.pengajuanSurat',compact('data'));
    }

    public function suratMasuk()
    {
        $id=auth()->user()->name;
        $kategori=auth()->user()->kategori;
      
        $data=Surat::select('surat.id','surat.name','users.cabang','surat.kategori','surat.perihal','surat.kategori','surat.status','surat.file','surat.created_at as tanggal_surat','surat.keterangan_validasi','users.name as nama_pengirim')->where('surat.id_penerima','=',$id)->orWhere('surat.id_penerima','=',$kategori)->join('users','surat.users_id','=','users.id')->orderBy('surat.created_at','desc')->simplePaginate(10);
        return view('user.suratMasuk',compact('data'));
    }

    public function userDownloadSurat($id)
    {
        $file = public_path('assets/surat/'). $id;
        return response()->download($file);
    }


}
