@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="text-end mb-2">
                    <a class="btn btn-success" href="{{ route('sips.create') }}"> Add sip</a>
                    
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
    @foreach ($sips as $sip)
    <tr>
        <td>{{ $sip->id }}</td>
        <td>{{ $sip->name }}</td>
        <td>{{ $sip->location }}</td>
        <td>{{ 
            (isset($sip->getManager->name)) ?
            $sip->getManager->name :
            'Tidak Ada'
            }}
        </td>
        <td>
            <form action="{{ route('sips.destroy',$sip->id) }}" method="Post">
                <a class="btn btn-primary" href="{{ route('sips.edit',$sip->id) }}">Edit</a>
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