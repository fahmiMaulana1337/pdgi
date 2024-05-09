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
<div class="container">
    <div class="row justify-content-center" style="margin-top: 50px; margin-bottom:200px ;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Upload Surat') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin-postUpload') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Judul Surat') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="perihal" class="col-md-4 col-form-label text-md-end">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <textarea name="perihal" id="perihal" cols="30" rows="10" @error('perihal') is-invalid @enderror name="perihal" value="{{ old('keterangan') }}"></textarea>

                                @error('perihal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
   
                        <div class="row mb-3">
                            <label for="kategori" class="col-md-4 col-form-label text-md-end" required>{{ __('Kategori') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="kategori" id="kategori">
                                    <option value="">--Pilih Kategori--</option>
                                    <option value="Cabang">Cabang</option>
                                    <option value="Umum">Umum</option>
                                    <option value="PB">PB</option>
                                  </select>


                                @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_pengirim" class="col-md-4 col-form-label text-md-end">{{ __('Nama Pengirim') }}</label>

                            <div class="col-md-6">
                                <input id="nama_pengirim" type="nama_pengirim" class="form-control @error('nama_pengirim') is-invalid @enderror" name="nama_pengirim">

                                @error('nama_pengirim')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        <div class="row mb-3">
                            <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('Upload Surat') }}</label>

                            <div class="col-md-6">
                                <input id="file" type="file" class="form-control @error('file') is-invalid @enderror" name="file" value="{{ old('file') }}" required autocomplete="file" autofocus>

                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Kirim Surat') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection