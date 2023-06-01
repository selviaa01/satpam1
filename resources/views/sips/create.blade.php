@extends('app')
@section('content')
<form action="{{ route('sips.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Satpam :</strong>
                <input type="text" name="nama_satpam" class="form-control" placeholder="Nama Satpam">
                @error('nama_satpam')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Jaga :</strong>
                <input type="date" name="tanggal_jaga" class="form-control" placeholder="Tanggal Jaga">
                @error('tanggal_jaga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tempat Jaga :</strong>
                <select name="tempat_jaga" id="tempat_jaga" class="form-select">
                    <option value="">Pilih</option>
                    @foreach($managers as $item)
                    <option value="{{ $item->id }}">{{ $item->tempat_jaga }}</option>
                    @endforeach
                </select>
                @error('tempat_jaga')
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
                        <th scope="col">Nama Satpam</th>
                        <th scope="col">Tanggal Jaga</th>
                        <th scope="col">Tempat Jaga</th>
                        <th scope="col">Sesi Jaga</th>
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
    var path = "{{ route('search.sip') }}";

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