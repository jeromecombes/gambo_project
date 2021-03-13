@extends('layouts.myApp')
@section('content')

<h3>Housing</h3>

@if (session('admin'))
  @include('students.housing_admin')
@endif

@if (substr(session('semester'), -4) < 2020)
  @include('students.housing_before_2020')
@else
  @include('students.housing_2020')
@endif

@endsection