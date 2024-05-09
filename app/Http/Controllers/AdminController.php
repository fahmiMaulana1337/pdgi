<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Surat;

use App\Helpers\Storage;
use App\Mail\MailNotify;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.isAdmin');
    }

    public function daftarPengajuan()
    {
        $data=Surat::select('surat.id','surat.name','surat.kategori','users.cabang','surat.perihal','surat.kategori','surat.status','surat.file','surat.created_at as tanggal_surat','surat.keterangan_validasi','users.name as nama_pengirim')->where('level','=','1')->join('users','surat.users_id','=','users.id')->orderBy('surat.created_at','desc')->get()->toArray();
        // dd($data);
        return view ('admin.daftarPengajuan',compact('data'));
    }

    public function uploadSurat()
    {
        $data=User::all();
        return view('admin.uploadSurat',compact('data'));
    }

    public function postUpload(Request $req)
    {
        $name=$req->input('name');
        $perihal=$req->input('perihal');
        $file=$req->file('file');
        $kategori=$req->input('kategori');
        // $cabang=$req->input('kategori');
        $nama_pengirim=$req->input('nama_pengirim');
        if( empty($file))
        {
            return back()->with('failed','File Tidak Ada');
        }
        $uploadDokumen= Storage::uploadSurat($file);

        $data= new Surat();
        $data->name=$name;
        $data->perihal=$perihal;
        $data->file=$uploadDokumen;
        $data->kategori=$kategori;
        $data->nama_pengirim=$nama_pengirim;
        $data->users_id=auth()->user()->id;
        $data->status="Menunggu";
        $data->level=1;
        // dd($data);
        $data->save();

        return redirect()->route('admin-uploadSurat')->with('success', 'Surat Berhasil Di Upload!');   
    }

    public function balasSurat()
    {
        $data=User::where('name','!=','Firda')->where('name','!=','Super Admin')->get()->toArray();
        // dd($data);
        return view('admin.balasSurat',compact('data'));
    }

    public function suratKeluar()
    {
        $data=Surat::select('surat.id','surat.name','surat.kategori','users.cabang','surat.perihal','surat.kategori','surat.status','surat.file','surat.id_penerima','surat.created_at as tanggal_surat','surat.keterangan_validasi','users.name as nama_pengirim')->where('level','=','4')->join('users','surat.users_id','=','users.id')->orderBy('surat.created_at','desc')->simplePaginate(10);
        return view('admin.suratKeluar',compact('data'));
    }

    public function postBalas(Request $req)
    {
        $name=$req->input('name');
        $perihal=$req->input('perihal');
        $file=$req->file('file');
      
        $penerima="";
        $person =$req->input('penerima'); //(idpenerima)
        $semuaCabang=$req->input('semuaCabang');
        $semuaFkg=$req->input('semuaFkg');
        // dd($semuaCabang);
        if($person)
        {
           $penerima=$person;
        }
        elseif($semuaCabang)
        {
            $penerima=$semuaCabang;
        }
        elseif($semuaFkg)
        {
            $penerima=$semuaFkg;
        }
        
        if($person && $semuaCabang || $person && $semuaFkg ||$semuaFkg && $semuaCabang )
        {
            return back()->with('failed','hanya Boleh Check 1 broadcast');
        }

        
        if( empty($file))
        {
            return back()->with('failed','File Tidak Ada');
        }
        $uploadDokumen= Storage::uploadSurat($file);

        $data= new Surat();
        $data->name=$name;
        $data->perihal=$perihal;
        $data->file=$uploadDokumen;
        $data->kategori="Cabang";
        $data->id_penerima=$penerima;
        $data->nama_pengirim="Firda";
        $data->users_id=auth()->user()->id;
        $data->id_penerima=$penerima;
        $data->status="Sudah Di Proses";
        $data->level=4;
        // dd($data);
        $data->save();

        return redirect()->route('admin-balasSurat')->with('success', 'Surat Berhasil di Kirim!!!');     
    }



    public function daftarSuratValidasi()
    {
         $data=Surat::select('surat.id','surat.name','surat.action','surat.kategori','users.cabang','surat.perihal','surat.kategori','surat.status','surat.file','surat.created_at as tanggal_surat','surat.keterangan_validasi','users.name as nama_pengirim')->where('level','=','3')->join('users','surat.users_id','=','users.id')->orderBy('surat.created_at','desc')->simplePaginate(10);
        return view('admin.daftarSuratValidasi',compact('data'));
    }

    public function downloadSurat($id)
    {
        $file = public_path('assets/surat/'). $id;
        return response()->download($file);
    }

    public function teruskanSurat($id)
    {
        $data= Surat::find($id);
        $data->level=2;
        $data->status="Sedang di proses";
        $data->save();

        $data=[
            'subject'=>'Surat Masuk',
            'body'=>'Surat Masuk Bos',
        ];
            Mail::to('farhanmaulana929@gmail.com')->send(new MailNotify($data));
            //  dd("Email Sent");
            return redirect()->route('admin-daftarPengajuan')->with('success', 'Notifikasi Berhasil di Kirim!!!');
    }


    public function arsipSurat(Request $request)
    {

        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->orderBy('surat.created_at','desc')
        ->simplePaginate(10);
        
        
        return view('admin.arsipSurat',compact('data'));
    }

    public function filterKategoriUmum()
    {
     
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->where('surat.kategori','=','Umum')->simplePaginate(10);
        return view('admin.arsipSurat',compact('data'));
    }

    public function filterKategoriCabang()
    {
       
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->where('surat.kategori','=','Cabang')->simplePaginate(10);
        return view('admin.arsipSurat',compact('data'));
    }

    public function filterTerlama()
    {
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->orderBy('surat.created_at','asc')->simplePaginate(10);
        return view('admin.arsipSurat',compact('data'));
    }
    public function filterTerbaru()
    {
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->orderBy('surat.created_at','desc')->simplePaginate(10);
        return view('admin.arsipSurat',compact('data'));
    }

    public function searchArsip(Request $request)
    {
 
        if($request->has('search'))
        {
        $search_text=$_GET['search'];
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->Where('surat.kategori','LIKE','%'.$search_text.'%')
        ->orWhere('surat.name','LIKE','%'.$search_text.'%')->
        orWhere('users.name','LIKE','%'.$search_text.'%')->
        orWhere('users.cabang','LIKE','%'.$search_text.'%')->simplePaginate(10);
        }
        else{
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->simplePaginate(10);
        }
        
        return view('admin.arsipSurat',compact('data'));
    }


}
