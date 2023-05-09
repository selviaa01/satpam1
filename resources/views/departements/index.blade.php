<?php use App\Models\User; ?>
@extends('app')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{session('success')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
</div>
@endif
<div class="text-end mb-2">
  <a class="btn btn-success" href="{{ route('departements.exportPdf') }}"> Export</a>"
  <a class="btn btn-success" href="{{ route('departements.create') }}"> Add Departement</a>
</div>

<table id="example" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Manager Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @php $no = 1 @endphp
    @foreach ($departements as $data)
    <tr>
      <td>{{ $no ++ }}</td>
      <td>{{ $data->name }}</td>
      <td>{{ $data->location }}</td>
      <td>{{
    (isset($data->manager->email)) ?
      $data->manager->email :
    
      'Tidak ada manager'
}}
  </td>
      <td>
        <form action="{{ route('departements.destroy',$data->id) }}" method="Post">
          <a class="btn btn-primary" href="{{ route('departements.edit',$data->id) }}">Edit</a>
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
@section ('js')
<script>
  $(document).ready(function () {
    $('#example').DataTable();
});
</script>