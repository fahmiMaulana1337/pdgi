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
    <h1 class="h3 mb-2 text-gray-800"> Surat Keluar Cabang <span
            style="color: rgb(28, 28, 255)">{{ auth()->user()->cabang }}</span></h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">SURAT KELUAR </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Judul Surat</th>
                            <th>Cabang/Lembaga</th>
                            {{-- <th>Kategori</th> --}}
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Tanggal Surat</th>
                            <th>Kepada</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)

                        <tr>
                            <td>{{ $d['name'] }}</td>
                            <td>{{ $d['cabang'] }}</td>
                            {{-- <td>{{ $d['kategori'] }}</td> --}}
                            <td>{{ $d['perihal'] }}</td>
                            <td>{{ $d['status'] }}</td>
                            <td>{{ $d['tanggal_surat'] }}</td>
                            <td>{{ $d['id_penerima'] }}</td>
                            <td><a onclick="window.location.href='{{ route('user-downloadSurat',$d['file']) }}'"
                                    class="btn btn-warning">Download</a></td>
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
