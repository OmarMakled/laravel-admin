@extends('admin')

@section('content')
<page :model="'{{$model}}'" :back="true"></page>
<form-upload :model="'{{$model}}'" :id="'{{$id}}'"></form-upload>
@endsection
