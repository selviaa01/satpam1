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
        @foreach ($sips as $sip)
        <?php $no++; ?>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $sip->name }}</td>
            <td>{{ $sip->location }}</td>
            <td>{{
                (isset($sip->getManager->name))?
                $sip->getManager->name :
                'Tidak Ada' 
                }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection