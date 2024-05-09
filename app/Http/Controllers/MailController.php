<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\MailNotify;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $data=[
            'subject'=>'Surat Masuk',
            'body'=>'Surat Masuk Bos',
        ];
            Mail::to('farhanmaulana929@gmail.com')->send(new MailNotify($data));
            //  dd("Email Sent");
            return redirect()->route('admin-daftarPengajuan')->with('success', 'Notifikasi Berhasil di Kirim!!!');
    }
}
