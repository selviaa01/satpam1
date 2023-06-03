@extends('layout')
@section('content')
<table class="table mt-5">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Location</th>
            <th scope="col">Manager Name</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; ?>
        @foreach ($transs as $trans)
        <?php $no++; ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $trans->name }}</td>
            <td>{{ $trans->location }}</td>
            <td>{{
                (isset($trans->getManager->name))?
                $trans->getManager->name :
                'Tidak Ada' 
                }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection