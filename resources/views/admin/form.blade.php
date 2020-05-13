@extends('admin')

@section('content')
<page :model="'{{$model}}'" :back="true"></page>
<form-model :model="'{{$model}}'" :id="'{{$id}}'"></form-model>
@endsection
