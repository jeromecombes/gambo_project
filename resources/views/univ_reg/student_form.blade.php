@extends('layouts.myApp')
@section('content')

  @include('univ_reg.student_form_intro')

  @if (substr(session('semester'), -4) < 2019)

    @include('univ_reg.student_form_before_2019')
    @include('univ_reg.student_form_final')

    @if (Auth::user()->admin or $locked)

      @include('univ_reg.student_form_before_2019_plus')

    @endif

  @else

      @include('univ_reg.student_form_2019')

    @if (Auth::user()->admin or $published)

      @include('univ_reg.student_form_final')

    @endif

  @endif

@endsection
