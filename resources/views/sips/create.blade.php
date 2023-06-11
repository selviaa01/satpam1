@extends('app')
@section('content')
<form action="{{ route('satpams.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>NO Satpam:</strong>
                <input type="text" name="no_satpam" class="form-control" placeholder="No Satpam">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>No HP</strong>
                <input type="text" name="no_hp" class="form-control" placeholder="No HP">
                @error('location')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Satpam:</strong>
                <select name="nama_satpam" id="nama_satpam" class="form-select" >
                        <option value="">Pilih</option>
                        @foreach($managers as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                </select>
                @error('alias')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>bahasa:</strong>
                <input type="text" name="bahasa" class="form-control" placeholder="bahasa">
                @error('name')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row col-xs-12 col-sm-12 col-md-12 mt-3">
            <div class="col-md-10 form-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Masukan Sertifikasi Keamanan">
                @error('name')
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
                    <th scope="col">Nama Satpam</th>
                    <th scope="col">Jam Jaga</th>
                    <th scope="col">Tanggal Jaga</th>
                    <th scope="col">Tempat Jaga</th>
                    <th scope="col">Hari Jaga</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="detail">
                    
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jumlah Data :</strong>
                <input type="text" name="jumlah" class="form-control" placeholder="Jumlah Data">
                @error('bulan')
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
        source: function( request, response ) {
          $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            data: {
               search: request.term
            },
            success: function( data ) {
               response( data );
            }
          });
        },
        select: function (event, ui) {
           $('#search').val(ui.item.label);
        //    console.log(ui.item); 
           add(ui.item.id);
           return false;
        }
      });

      function add(id){
        const path = "{{ route('sips.index') }}/" + id;
        var html = "";
        var no=0;
        if($('#detail tr').length > 0){
            var html = $('#detail').html();
            no = no+$('#detail tr').length;
        }
        $.ajax({
            url: path,
            type: 'GET',
            dataType: "json",
            success: function( data ) {
                console.log(data); 
                no++;
                html += '<tr>' +
                   '<td>'+no+'<input type="hidden" name="no_satpam'+no+'" class="form-control" value="'+data.id+'"></td>' +
                    '<td><input type="text" name="jam_jaga'+no+'" class="form-control" value="'+data.jam_jaga+'"></td>' +
                    '<td><input type="text" name="tgl_jaga'+no+'" class="form-control" value="'+data.tgl_jaga+'"></td>' +
                    '<td><input type="text" name="sertifikasi_keamanan'+no+'" class="form-control" value="'+data.sertifikasi_keamanan+'"></td>' +
                    '<td><input type="text" name="tempat_jaga'+no+'" class="form-control"></td>' +
                    '<td><input type="text" name="hari_jaga'+no+'" class="form-control"></td>' +
                    '<td><a href="#" class="btn btn-sm btn-danger">X</a></td>' +
                '</tr>';
             $('#detail').html(html);
            }
        });
    }

    // function sumQty(no, q){
    //     var price = $("input[name=price"+no+"]").val();
    //     var subtotal = q*parseInt(price);
    //     $("input[name=sub_total"+no+"]").val(subtotal);
    //     console.log(q+"*"+price+"="+subtotal);
    // }

    // function sumTotal(){
    // var total = 0;
    //     for (let i = 1; i <= $("input[name=jml]").val(); i++) {
    //         var sub = $("input[name=sub_total]"+i+"]").val();
    //         total = total + parseInt(sub);
    //     }
    //     $("input[name=total]").val();
    // }

</script>
@endsection