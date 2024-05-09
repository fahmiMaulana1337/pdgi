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
                <div class="card-header">{{ __('Kirim Surat') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin-postBalas') }}" enctype="multipart/form-data">
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
                                <input id="perihal" type="perihal" class="form-control @error('perihal') is-invalid @enderror" name="perihal">

                                @error('perihal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="broadcast" class="col-md-4 col-form-label text-md-end">{{ __('Broadcast') }}</label>

                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox" id="users" name="" value="">
                                    <label for="users">Pilih penerima</label>
                                    <select class="form-control" name="penerima" id="users-list" hidden>
                                        <option value="">--Pilih penerima--</option>
                                        @foreach ($data as $d)
                                        <option value="{{ $d['name'] }}">{{ $d['cabang'] }}</option>                                   
                                        @endforeach
                                      </select>

                                    <div class="">
                                    <input type="checkbox" name="semuaCabang" value="1" id="send-all-cabang">
                                    <label for="send-all-cabang">Kirim Semua Cabang</label>
                                    <br>
                                    <input type="checkbox" name="semuaFkg" value="2" id="send-all-fkg">
                                    <label for="send-all-fkg">Kirim Semua FKG</label>
                                    </div>
                                  </div>

                                @error('broadcast')
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

<script>
const radioBtn = document.getElementById('users');
const userList = document.getElementById('users-list');
const allCabang = document.getElementById('send-all-cabang');
const allFkg = document.getElementById('send-all-fkg');


radioBtn.addEventListener('change',(event) => {
  const isChecked = event.target.checked
//   isChecked ? userList.hidden = false : 
    if(isChecked){
        allCabang.disabled=true;
        allFkg.disabled=true;
        userList.hidden=false;

    }
    else{
        allCabang.disabled=false;
        allFkg.disabled=false;
        userList.hidden=true;
    }
})

allCabang.addEventListener('change',(event) => {
  const isChecked = event.target.checked
//   isChecked ? userList.hidden = false : 
    if(isChecked){
        allCabang.disabled=false;
        allFkg.disabled=true;
        userList.hidden=true;
        radioBtn.disabled=true;
        
    }
    else{
        allCabang.disabled=false;
        allFkg.disabled=false;
        userList.hidden=true;
        radioBtn.disabled=false;
    }
})
allFkg.addEventListener('change',(event) => {
  const isChecked = event.target.checked

    if(isChecked){
        allCabang.disabled=true;
        allFkg.disabled=false;
        userList.hidden=true;
        radioBtn.disabled=true;
    }
    else{
        allCabang.disabled=false;
        allFkg.disabled=false;
        userList.hidden=true;
        radioBtn.disabled=false;
    }
})

</script>
@endsection