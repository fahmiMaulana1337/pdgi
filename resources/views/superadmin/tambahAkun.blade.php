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
<div class="container" style="margin-bottom:380px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Akun') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('postAkun') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="kategori" class="col-md-4 col-form-label text-md-end">{{ __('Kategori') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="kategori" id="kategori">
                                    <option value="">--Pilih Kategori--</option>
                                    <option value="1">Cabang</option>
                                    <option value="2">Universitas</option>
                                </select>

                                @error('npa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="cabang" class="col-md-4 col-form-label text-md-end">{{ __('Cabang') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="cabang" id="cabang">
                                    <option value="">--Pilih Kabupaten/Fakultas--</option>
                                    <option value="Bangkalan">Bangkalan</option>
                                    <option value="Banyuwangi">Banyuwangi</option>
                                    <option value="Blitar">Blitar</option>
                                    <option value="Bojonegoro">Bojonegoro</option>
                                    <option value="Bondowoso">Bondowoso</option>
                                    <option value="Gresik">Gresik</option>
                                    <option value="Jember">Jember</option>
                                    <option value="Jombang">Jombang</option>
                                    <option value="Kediri">Kediri</option>
                                    <option value="Lamongan">Lamongan</option>
                                    <option value="Lumajang">Lumajang</option>
                                    <option value="Madiun">Madiun</option>
                                    <option value="Magetan">Magetan</option>
                                    <option value="Kabupaten Malang">Kabupaten Malang</option>
                                    <option value="Mojokerto">Mojokerto</option>
                                    <option value="Nganjuk">Nganjuk</option>
                                    <option value="Ngawi">Ngawi</option>
                                    <option value="Pacitan">Pacitan</option>
                                    <option value="Pamekasan">Pamekasan</option>
                                    <option value="Pasuruan">Pasuruan</option>
                                    <option value="Ponorogo">Ponorogo</option>
                                    <option value="Probolinggo">Probolinggo</option>
                                    <option value="Sampang">Sampang</option>
                                    <option value="Sidoarjo">Sidoarjo</option>
                                    <option value="Situbondo">Situbondo</option>
                                    <option value="Sumenep">Sumenep</option>
                                    <option value="Trenggalek">Trenggalek</option>
                                    <option value="Tuban">Tuban</option>
                                    <option value="Tulungagung">Tulungagung</option>
                                    <option value="Kota Malang">Kota Malang</option>
                                    <option value="FKG Hang Tuah">FKG Universitas Hang Tuah</option>
                                    <option value="FKG Hang Tuah">FKG Universitas Brawijaya</option>
                                    <option value="FKG Hang Tuah">FKG Universitas Jember</option>
                                    <option value="FKG Hang Tuah">FKG Universitas Airlangga</option>
                                    <option value="FKG Hang Tuah">FKG Institut Ilmu Kediri</option>
                                    <option value="FKG Hang Tuah">FKG Politeknik Kesehatan Surabaya</option>                                  
                                  </select>


                                @error('cabang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="foto" class="col-md-4 col-form-label text-md-end">{{ __('Upload foto') }}</label>

                            <div class="col-md-6">
                                <input id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" value="{{ old('foto') }}" required autocomplete="foto" autofocus>

                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end" required>{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" name="role" id="role">
                                    <option value="">--Pilih Role--</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                    <option value="3">User</option>
                                  </select>


                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Tambah Akun') }}
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