<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class SuperAdminController extends Controller
{
    public function index()
    {
        return view('superadmin.isSuperAdmin');
    }

    public function tambahAkun()
    {
        return view ('superadmin.tambahAkun');
    
    }

    public function daftarSurat()
    {
        $data=Surat::select('surat.id','surat.name','surat.kategori','users.cabang','surat.perihal','surat.kategori','surat.status','surat.file','surat.created_at as tanggal_surat','surat.keterangan_validasi','users.name as nama_pengirim')->where('level','=','2')->join('users','surat.users_id','=','users.id')->simplePaginate(10);
        // dd($data);
        return view('superadmin.daftarPengajuan',compact('data'));
    }
    public function daftarSuratValidasi()
    {
        $data=Surat::select('surat.id','surat.name','surat.kategori','users.cabang','surat.perihal','surat.kategori','surat.status','surat.file','surat.created_at as tanggal_surat','surat.keterangan_validasi','users.name as nama_pengirim')->where('level','=','3')->join('users','surat.users_id','=','users.id')->simplePaginate(10);
        // dd($data);
        return view('superadmin.daftarSuratValidasi',compact('data'));
    }


    public function postAkun(Request $req)
    {
        $nama= $req->input('name');
        $email= $req->input('email');
        $password= $req->input('password');
        $npa= $req->input('npa');
        $cabang= $req->input('cabang');
        $foto= $req->file('foto');
        $role=$req->input('role');
        $kategori=$req->input('kategori');

        $hash=Hash::make($password);

        if (User::where('cabang', $cabang )->exists()) {
            return back()->with('failed', 'Cabang Sudah Terdaftar');
        }

         $data= new User();
         $data->name=$nama;
         $data->email=$email;
         $data->npa=$npa;
         $data->cabang=$cabang;
         $data->foto="data:".$foto->getMimeType().";base64,".base64_encode(file_get_contents($foto));
         $data->password=$hash;
         $data->role=$role;     
         $data->kategori=$kategori;  
        
         $data->save(); 
         
 
         
         return redirect()->route('databaseAkun')->with('success', 'Akun Berhasil di Tambahkan!!!');
        
       

        
        


    }

    public function databaseAkun()
    {
        $data=User::where('role','=','3')->get()->toArray();
        return view('superadmin.databaseAkun', compact('data'));
    }

    public function editAkun($id)
    {
        $data=User::findOrFail($id);
        // dd($data);
        return view('superadmin.editAkun',compact('data'));
    }

    public function updateAkun(Request $req, $id)
    {
        $nama= $req->input('name');
        $email= $req->input('email');
        $password= $req->input('password');
        $npa= $req->input('npa');
        $cabang= $req->input('cabang');
        $foto= $req->file('foto');
        $role=$req->input('role');

        $hash=Hash::make($password);
        
        // $query=User::where('cabang','=','$cabang');
        // if(!empty($query))
        // {
        //     return back()->with('failed', 'Cabang Sudah Terdaftar');
        // }

        $data=User::find($id);
        $data->name=$nama;
        $data->email=$email;
        $data->npa=$npa;
        $data->cabang=$cabang;
        $data->foto="data:".$foto->getMimeType().";base64,".base64_encode(file_get_contents($foto));
        $data->password=$hash;
        $data->role=$role;       
        // dd($data);
        $data->save(); 

        
        return redirect()->route('databaseAkun')->with('success', 'Edit Data Berhasil!!!');
    }

    public function downloadSurat($id)
    {
        $file = public_path('assets/surat/'). $id;
        return response()->download($file);
    }

    public function acceptSurat($id)
    {
       
        $data=Surat::findOrFail($id);
        
        return view('superadmin.accept',compact('data'));
    }

    public function postAccept(Request $req,$id)
    {
        $keterangan=$req->input('keterangan_validasi');
        $action=$req->input('action');
        $data=Surat::findOrfail($id);
        $data->level=3;
        $data->keterangan_validasi=$keterangan;
        $data->status='Sudah di Proses';
        $data->action=$action;
        $data->save();

        return redirect()->route('daftarSurat')->with('success',"Surat Berhasil Di Validasi");

    }
    public function tolakSurat($id)
    {
       
        $data=Surat::findOrFail($id);
        
        return view('superadmin.tolak',compact('data'));
    }

    public function postTolak(Request $req,$id)
    {
        $keterangan=$req->input('keterangan_validasi');
        $data=Surat::findOrfail($id);
        $data->level=3;
        $data->keterangan_validasi=$keterangan;
        $data->status='Di Tolak';
        $data->save();

        return redirect()->route('daftarSurat')->with('success',"Surat Berhasil Di Validasi");

    }

    public function deleteAkun($id)
    {
        
        
            $data=User::find($id);
            $p="pdginonaktif2022";
            $password=Hash::make($p);
            $data->password=$password;
            $data->save();
            return back()->with('success','Password berhasil di reset, User tidak dapat login kembali');
        
    
    }

    public function arsipSurat(Request $request)
    {

        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','surat.id_penerima','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->orderBy('surat.created_at','desc')->simplePaginate(10);
        
        
        return view('superadmin.arsipSurat',compact('data'));
    }

    public function filterKategoriUmum()
    {
     
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->where('surat.kategori','=','Umum')->get()->toArray();
        return view('superadmin.arsipSurat',compact('data'));
    }

    public function filterKategoriCabang()
    {
       
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->where('surat.kategori','=','Cabang')->get()->toArray();
        return view('superadmin.arsipSurat',compact('data'));
    }

    public function filterTerlama()
    {
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->orderBy('surat.created_at','asc')->get()->toArray();
        return view('superadmin.arsipSurat',compact('data'));
    }
    public function filterTerbaru()
    {
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->orderBy('surat.created_at','desc')->get()->toArray();
        return view('superadmin.arsipSurat',compact('data'));
    }

    public function searchArsip(Request $request)
    {
 
        if($request->has('search'))
        {
        $search_text=$_GET['search'];
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->Where('surat.kategori','LIKE','%'.$search_text.'%')
        ->orWhere('surat.name','LIKE','%'.$search_text.'%')->
        orWhere('users.name','LIKE','%'.$search_text.'%')->
        orWhere('users.cabang','LIKE','%'.$search_text.'%')->get()->toArray();
        }
        else{
        $data=Surat::select('surat.kategori','surat.file','surat.name as judul','surat.created_at  as tanggal_surat','users.name','users.cabang')->join('users','users.id','=','surat.users_id')->get()->toArray();
        }
        
        return view('superadmin.arsipSurat',compact('data'));
    }

}
