@extends('app')
@section('content')
<form action="{{ route('transs.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Obat :</strong>
                <input type="text" name="nama_obat" class="form-control" placeholder="Nama Obat">
                @error('nama_obat')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jenis Obat :</strong>
                <select name="jenis_obat" id="jenis_obat" class="form-select">
                    <option value="">Pilih</option>
                    @foreach($managers as $item)
                    <option value="{{ $item->id }}">{{ $item->jenis_obat }}</option>
                    @endforeach
                </select>
                @error('jenis_obat')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="col-md-10 form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukkan Sesi Jaga Anda">
                @error('search')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 form-group text-center">
                <button class="btn btn-secondary" type="button" name="btnAdd" id="btnAdd" onclick="tambahData()"><i class="fa fa-plus"></i>Tambah</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Jenis Obat</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
    </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
    var path = "{{ route('search.trans') }}";

    $("#search").autocomplete({
        source: function (request, response) {
            $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
            search: request.term
            },
            success: function (data) {
            response(data);
            }
            });
            },
            select: function (event, ui) {
            $('#search').val(ui.item.label);
            console.log(ui.item);
            return false;
            }
            });

</script>
@endsection