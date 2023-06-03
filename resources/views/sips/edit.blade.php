@extends('app')
@section('content')
<form action="{{ route('transs.update', $trans->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Obat :</strong>
                <input type="text" name="name" class="form-control" placeholder="Nama Obat" value="{{ $trans->name }}">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Obat :</strong>
                <select name="manager_id" id="manager_id" class="form-select" >
                        <option value="" >Pilih</option>
                        @foreach($managers as $item)
                        <option value="{{ $item->id }}" {{ ($item->id == $trans->manager_id) ? 'selected' : ''}}> {{ $item->jenis_obat }}</option>
                        @endforeach
                </select>
                @error('jenis_obat')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-10 form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukan Sesi Jaga Anda">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
    </div>
</form>
@endsection