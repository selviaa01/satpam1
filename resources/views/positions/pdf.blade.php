@extends('layout')
@section('content')
<table class="table mt-5">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Singkatan</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 0; ?>
  @foreach ($departements as $data)
    <?php $no++; ?>
      <tr>
        <td>{{ $data->id }}</td>
        <td>{{ $data->name }}</td>
        <td>{{ $data->keterangan }}</td>
        <td>{{ $data->alias }}</td>
        <td>{{
          (isset($data->getManager->name)) ?
          $data->getManager->name :
          'Tidak Ada'
          }}

          </td>
        </tr>
   @endforeach
  </tbody>
</table>
@endsection