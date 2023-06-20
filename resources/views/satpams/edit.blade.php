@extends('app')
@section('content')

<form action="{{ route('satpams.update',$satpam->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>KD Satpam :</strong>
                <input type="text" name="kd_satpam" class="form-control" placeholder="kd_satpam">
                @error('kd_satpam')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Jaga :</strong>
                <input type="date" name="tgl_jaga" class="form-control" placeholder="Tanggal Jaga">
                @error('tgl_jaga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Satpam :</strong>
                <select name="nama_satpam" id="nama_satpam" class="form-select">
                    <option value="">Pilih</option>
                    @foreach($managers as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('nama_satpam')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="col-md-10 form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukan Sesi Jaga">
                @error('sesi_jaga')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-2 form-group text-center">
                <button class="btn btn-secondary" type="button" name="btnAdd" id="btnAdd"><i class="fa fa-plus"></i>Tambah</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sesi Jaga</th>
                        <th scope="col">Jam Jaga</th>
                        <th scope="col">Sertifikasi keamanan</th>
                        <th scope="col">Tempat Jaga</th>
                        <th scope="col">Seragam Jaga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="detail">
                </tbody>
        </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Jumlah Sertifikasi :</strong>
            <input type="text" name="jml" class="form-control" placeholder="Jumlah Sertifikasi">
            @error('jml')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
</div>
</form>
@endsection
@section('js')

<script type="text/javascript">
    var path = "{{ route('search.sip') }}";

    $("#search").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: path,
                type: 'GET',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        select: function(event, ui) {
            $('#search').val(ui.item.label);
            console.log($("input[name=jml]").val());
            if ($("input[name=jml]").val() > 0) {
                for (let i = 1; i <= $("input[name=jml]").val(); i++) {
                    id = $("input[name=kd_sip" + i + "]").val();
                    if (id == ui.item.id) {
                        alert(ui.item.value + ' sudah ada!');
                        break;
                    } else {
                        add(ui.item.id);
                    }
                }
            } else {
                add(ui.item.id);
            }
            return false;
        }
    });

    function add(id) {
        const path = "{{ route('satpams.index') }}/" + id;
        var html = "";
        var no = 0;
        if ($('#detail tr').length > 0) {
            var html = $('#detail').html();
            no = no + $('#detail tr').length;
        }
        $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            success: function(data) {
                console.log(data);
                no++;
                html += '<tr>' +
                    '<td>' + no + '<input type="hidden" name="kd_sip' + no + '" class="form-control" value="' + data.id + '"></td>' +
                    '<td><input type="text" name="sesi_jaga' + no + '" class="form-control" value="' + data.sesi_jaga + '"></td>' +
                    '<td><input type="text" name="jam_jaga' + no + '" class="form-control" value="' + data.jam_jaga + '"></td>' +
                    '<td><input type="text" name="sertifikasi_keamanan' + no + '" class="form-control" value="' + data.sertifikasi_keamanan + '"></td>' +
                    '<td><input type="text" name="tempat_jaga' + no + '" class="form-control"></td>' +
                    '<td><input type="text" name="seragam_jaga' + no + '" class="form-control"></td>' +
                    '<td><a href="#" class="btn btn-sm btn-danger">X</a></td>' +
                    '</tr>';
                $('#detail').html(html);
                $("input[name=jml]").val(no);
            }
        });
    }
</script>
@endsection