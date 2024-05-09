@extends('layouts.main')

@section('content')
@if (session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif
@if (session('failed'))
  <div class="alert alert-danger">
      {{ session('failed') }}
  </div>
@endif
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Surat Keluar </h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Surat Keluar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">                  
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Nama Penerima</th> 
                            <th>Judul Surat</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Keterangan Validasi</th>
                            <th>Tanggal Surat</th>
                            <th>Download Surat</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            
                        <tr>
                            <td>{{ $d['kategori'] }}</td>
                            {{-- <td>{{ $d['cabang'] }}</td> --}}
                            <td>{{ $d['id_penerima'] }}</td>
                            <td>{{ $d['name'] }}</td>
                            <td>{{ $d['perihal'] }}</td>
                            <td>{{ $d['status'] }}</td>
                            <td>{{ $d['keterangan_validasi'] }}</td>
                            <td>{{ $d['tanggal_surat'] }}</td>
                            <td><a onclick="window.location.href='{{ route('downloadSurat',$d['file']) }}'" class="btn btn-warning">Download</a></td>
                            {{-- <td><a onclick="window.location.href='{{ route('teruskanSurat',$d['id'])}}'" class="btn btn-success">Teruskan</a></td> --}}


                            {{-- <td><button class="btn btn-success">Teruskan</button></td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
@endsection