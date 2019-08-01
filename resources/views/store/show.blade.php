@extends('layouts.app')
@section('content')
<h2>Store Details</h2>
<table>
    <tr>
    <th>Store Name</th>
    <td>{{$store->name}}</td>
    </tr>
    <tr>
    <th>Description</th>
    <td>{{$store->description}}</td>
    </tr>
    <tr>
    <th>Address</th>
    <td>{{$store->address}}</td>
    </tr>
</table>
@endsection