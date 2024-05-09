@extends('layouts.main')

@section('content')

<style>
    .b:hover {
        cursor: pointer;
        transform: scale(1.1, 1.1);
    }

</style>


        <div class="container" style="margin-bottom: 15%; margin-top: 5%;">
            <div class="row">
                <div class="col">
                    <a style=" text-decoration: none;" href="{{ route('daftarSurat') }}">
                        <center>
                            <div class="b">
                                <i class="bi bi-envelope" style="font-size: 200px;"></i>
                            </div>
                            <h2>Daftar Pengajuan Surat</h2>

                            <hr>
                        </center>
                    </a>
                </div>



                <div class="col">
                    <a style=" text-decoration: none;" href="{{ route('daftarSuratValidasi') }}">
                        <center>
                            <div class="b">
                                <i class="bi bi-envelope-check" style="font-size: 200px;"></i>
                            </div>
                            <h2>Surat Sudah Di Validasi</h2>

                            <hr>
                        </center>
                    </a>
                </div>



                <div class="col">
                    <a style=" text-decoration: none;" href="{{ route('arsipSurat') }}">
                        <center>
                            <div class="b">
                                <i class="bi bi-archive" style="font-size: 200px;"></i>
                            </div>
                            <h2>Arsip Surat</h2>

                            <hr>
                        </center>
                    </a>
                </div>
            </div>
        </div>

@endsection
