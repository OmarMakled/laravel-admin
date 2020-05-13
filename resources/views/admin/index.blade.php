@extends('admin')

@section('content')
<page :model="'{{$model}}'" :add="true"></page>
<dt-table model="{{$model}}" ref="dt"></dt-table>
@endsection