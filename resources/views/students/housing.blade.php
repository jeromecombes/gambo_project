@extends('layouts.myApp')
@section('content')

<h3>Housing</h3>

@if (session('admin') and !$edit)
  @include('students.housing_admin')
@endif


@if (!session('admin'))
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


@if (session('admin') and !$terms_accepted)
  <p>The terms and conditions are not accepted yet.</p>
@endif


@if ($terms_accepted)
  <form name='form' action='/housing' method='post'>
    {{ csrf_field() }}
    <input type='hidden' name='student' value='{{ $student->id }}' />

    <div class='fieldset'>

    @if (substr(session('semester'), -4) < 2020)
      @include('students.housing_before_2020')
    @else
      @include('students.housing_2020')
    @endif

      <p style='text-align:right'>
        @if ($edit)
          <input type='button' value='Cancel' class='btn' onclick='document.location.href="/housing";' />
          <input type='submit' value='Submit' class='btn btn-primary'/>
        @else
          <a href='{{ asset("housing/{$student->id}/edit") }}' class='btn btn-primary'>Edit</a>
        @endif
      </p>

    </div>
  </form>
@endif

@endsection