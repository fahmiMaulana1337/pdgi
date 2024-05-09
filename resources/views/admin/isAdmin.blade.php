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
                    <a style=" text-decoration: none;" href="{{ route('admin-uploadSurat') }}">
                        <center>
                            <div class="b">
                                <i class="bi bi-cloud-upload" style="font-size: 200px;"></i>
                            </div>
                            <h2>Upload Surat</h2>

                            <hr>
                        </center>
                    </a>
                </div>



                <div class="col">
                    <a style=" text-decoration: none;" href="{{ route('admin-balasSurat') }}">
                        <center>
                            <div class="b">
                                <i class="bi bi-envelope-plus" style="font-size: 200px;"></i>
                            </div>
                            <h2>Kirim Surat</h2>

                            <hr>
                        </center>
                    </a>
                </div>



                <div class="col">
                    <a style=" text-decoration: none;" href="{{ route('admin-daftarPengajuan') }}">
                        <center>
                            <div class="b">
                                <i class="bi bi-envelope" style="font-size: 200px;"></i>
                            </div>
                            <h2>Surat Masuk</h2>

                            <hr>
                        </center>
                    </a>
                </div>
            </div>
        </div>

@endsection
