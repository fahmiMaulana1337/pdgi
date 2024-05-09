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
                <div class="card-header">{{ __('Keterangan Validasi') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('postTolak',$data->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="keterangan_validasi" class="col-md-4 col-form-label text-md-end">{{ __('Keterangan') }}</label>

                            <div class="col-md-6">
                                <input id="keterangan_validasi" type="text" class="form-control @error('keterangan_validasi') is-invalid @enderror" name="keterangan_validasi" value="{{ old('keterangan') }}">

                                @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Validasi Surat Ini') }}
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