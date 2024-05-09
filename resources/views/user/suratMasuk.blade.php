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
    <h1 class="h3 mb-2 text-gray-800">Surat Masuk Cabang <span style="color: rgb(28, 28, 255)">{{ auth()->user()->cabang }}</span></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Surat Masuk </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{-- <th>Kategori</th>
                            <th>Cabang/Lembaga</th> --}}
                            <th>Nama Pengirim</th> 
                            <th>Judul Surat</th>
                            <th>Keterangan</th>
                            {{-- <th>Status</th>
                            <th>Keterangan Validasi</th> --}}
                            <th>Tanggal Surat</th>
                            <th>Download Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            
                        <tr>
                            {{-- <td>{{ $d['kategori'] }}</td>
                            <td>{{ $d['cabang'] }}</td> --}}
                            <td>{{ $d['nama_pengirim'] }}</td>
                            <td>{{ $d['name'] }}</td>
                            <td>{{ $d['perihal'] }}</td>
                            {{-- <td>{{ $d['status'] }}</td>
                            <td>{{ $d['keterangan_validasi'] }}</td> --}}
                            <td>{{ $d['tanggal_surat'] }}</td>
                            <td><a onclick="window.location.href='{{ route('user-downloadSurat',$d['file']) }}'" class="btn btn-warning">Download</a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
@endsection