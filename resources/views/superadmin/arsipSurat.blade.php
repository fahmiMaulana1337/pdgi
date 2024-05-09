@extends('layouts.main')

@section('content')

<style>
    @media (min-width: 1200px) {
        .hr{
            clear: both;
    visibility: hidden;
        }
     }
</style>
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
    <h1 class="h3 mb-2 text-gray-800">ARSIP SURAT</h1>


    <!-- DataTales Example -->
            <div class="card shadow mb-4">

                
            <div class="card-header py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">ARSIP SURAT</h6> --}}
               
                <div class="input-group" >
                    <div class="form-outline">
                    <form action="{{ route('search')}}" method="GET">
                    <input type="search" name="search" id="form1" class="form-control"  style="background-color: white;" />
                    <label class="form-label" for="form1">Search</label>
                    
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <hr class="hr">

            <div class="dropdown d-flex justify-content-end" style="margin-top:-9px;">
                
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Filter
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="{{ route('filterCabang') }}">Cabang</a>
                  <a class="dropdown-item" href="{{ route('filterUmum') }}">Umum</a>
                  <a class="dropdown-item" href="{{ route('filterTerbaru') }}">Terbaru</a>
                  <a class="dropdown-item" href="{{ route('filterTerlama') }}">Terlama</a>
                </div>
            </div>
        </div>

        <div class="card-body">
    <div class="table-responsive text-nowrap table-striped">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead >
                        <tr>
                            <th>Kategori</th>
                            <th>Cabang/Lembaga</th>
                            <th>Nama Pengirim</th> 
                            <th>Judul Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Kepada</th>
                            <th>Download Surat</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                       
                
                        <tr>
                            <td>{{ $d['kategori'] }}</td>
                            <td>{{ $d['cabang'] }}</td> 
                            <td>{{ $d['name'] }}</td>
                            <td>{{ $d['judul'] }}</td>
                           <td>{{ $d['tanggal_surat'] }}</td> 
                           @if( $d->id_penerima =="1")
                           <td>Semua Cabang</td>
                           @elseif($d->id_penerima =="2")
                           <td>Semua Cabang</td>
                           @else
                           <td>{{ $d['id_penerima'] }}</td>
                           @endif
                           
                            <td><a onclick="window.location.href='{{ route('super-downloadSurat',$d['file']) }}'" class="btn btn-success">Download</a></td>
                           
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
<script
type="text/javascript"
src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.4.0/mdb.min.js"
>
</script>
@endsection