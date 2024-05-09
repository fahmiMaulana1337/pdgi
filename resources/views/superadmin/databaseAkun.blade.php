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
    <h1 class="h3 mb-2 text-gray-800">Database Akun PDGI CABANG JAWA TIMUR</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DAFTAR AKUN</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Cabang</th>
                            {{-- <th>Name</th> --}}
                            <th>Email</th> 
                            {{-- <th>NPA</th> --}}
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                            
                        
                        <tr>
                            <td>{{ $d['cabang'] }}</td>
                            {{-- <td>{{ $d['name'] }}</td> --}}
                            <td>{{ $d['email'] }}</td>
                            {{-- <td>{{ $d['npa'] }}</td> --}}
                            <td><a href="editAkun/{{ $d['id'] }}"> <button class="btn btn-success">Edit</button></a></td>
                            <td><a type="button" class="btn btn-danger" onclick="return confirm('Ingin menghapus User ini?')" href="delete/{{$d['id']}}"> Delete</a></td>
                            
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