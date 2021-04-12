@extends('layouts.myApp')
@section('content')

<h3>Housing</h3>

@if (Auth::user()->admin and !$edit)
  @include('housing.student_form_admin')
@endif


@if (!Auth::user()->admin)
  <p>
    Welcome to the VWPP Housing questionnaire pages.<br/>
    Please take a few minutes to read through the Housing Process Residence commitment sections of the VWPP website by clicking on the link below, before proceeding to fill out the questionnaire.
  </p>
  <p>
    <a href='http://en.vwpp.org/wp-content/uploads/2019/04/Charte-hebergement-chez-habitant-F2019.pdf' target='_blank' alt='Housing Process Residence commitment'>Housing Process Residence commitment</a>
  </p>
  <p>
    <input type='checkbox' onclick='accept_housing_charte(this);' @if ($terms_accepted) checked='checked' @endif/> I accept the terms and conditions mentioned in the above link
  </p>
@endif


@if (Auth::user()->admin and !$terms_accepted)
  <p>The terms and conditions are not accepted yet.</p>
@endif


@if ($terms_accepted)
  <form name='form' action='/housing' method='post'>
    {{ csrf_field() }}
    <input type='hidden' name='student' value='{{ $student->id }}' />

    <fieldset>

    @if (substr(session('semester'), -4) < 2020)
      @include('housing.student_form_before_2020')
    @else
      @include('housing.student_form_2020')
    @endif

      <p style='text-align:right'>
        @if ($edit)
          <input type='button' value='Cancel' class='btn' onclick='document.location.href="/housing";' />
          <input type='submit' value='Submit' class='btn btn-primary'/>
        @elseif (!Auth::user()->admin or in_array(7, Auth::user()->access))
          <a href='{{ asset("housing/{$student->id}/edit") }}' class='btn btn-primary'>Edit</a>
        @endif
      </p>

    </fieldset>
  </form>
@endif

@endsection
