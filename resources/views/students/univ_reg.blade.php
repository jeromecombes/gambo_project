@extends('layouts.myApp')
@section('content')

  @include('students.univ_reg_intro')

  @if (session('admin') or $published)

    @if (substr(session('semester'), -4) < 2019)

      @include('students.univ_reg_before_2019')
      @include('students.univ_reg_final')

      @if (session('admin') or $locked)

        @include('students.univ_reg_before_2019_plus')

      @endif

    @else

      @include('students.univ_reg_2019')
      @include('students.univ_reg_final')

    @endif

  @endif

@endsection