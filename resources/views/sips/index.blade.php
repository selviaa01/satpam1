@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
                    <a class="btn btn-success" href="{{ route('transs.create') }}"> Add trans</a>
                    
                </div>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Manager Name</th>
            <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($transs as $trans)
    <tr>
        <td>{{ $trans->id }}</td>
        <td>{{ $trans->name }}</td>
        <td>{{ $trans->location }}</td>
        <td>{{ 
            (isset($trans->getManager->name)) ?
            $trans->getManager->name :
            'Tidak Ada'
            }}
        </td>
        <td>
            <form action="{{ route('transs.destroy',$trans->id) }}" method="Post">
                <a class="btn btn-primary" href="{{ route('transs.edit',$trans->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
@section('js')
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>
@endsection