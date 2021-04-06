@extends('layouts.myApp')
@section('content')

<h3>Evaluation</h3>

<p style='text-align:justify;'>
  Thank you for taking the time to fill out the following evaluation forms to the best of your ability.<br/><br/>
  Please note that evaluations for program, VWPP courses, and tutors will all be anonymous, unless you choose to identify yourself.<br/>
  Evaluations for university courses are for VWPP use only.  They will not be shared with your university professor.<br/><br/>
  You must complete these evaluation forms in order for your final grades to be sent to your institution.<br/><br/>
</p>


{{-- Program evaluation --}}

<h3>Program Evaluation</h3>
<fieldset>
  <ul>
    <li>
      @if (!$closed->program)
        <a href='/eval_index2.php?form=program' style='font-weight:bold;'>
          Program Evaluation @if ($closed->program) (done) @endif
        </a>
      @else
        Program Evaluation @if ($closed->program) (done) @endif
      @endif
    </li>
  </ul>
</fieldset>


{{-- @if (session('semester') != 'Spring 2020') --}}

  {{-- Local courses --}}

  <h3>VWPP Course Evaluation</h3>
  <fieldset>
    <ul>
      @if (empty($courses->local))
        <li style='color:red;font-weight:bold;'>No VWPP course selected</li>
      @endif

      @foreach ($courses->local as $course)
        <li>
          @if (!$closed->local[$course->id])
            <a href='/eval_index2.php?form=ReidHall&courseId={{ $course->id }}' style='font-weight:bold;'>
              Evaluation for {{ $course->name }}, {{ $course->professor }} @if ($closed->local[$course->id]) (done) @endif
            </a>
          @else
            Evaluation for {{ $course->name }}, {{ $course->professor }} @if ($closed->local[$course->id]) (done) @endif
          @endif
        </li>
      @endforeach
    </ul>
  </fieldset>


  {{-- University courses --}}

  <h3>University Course Evaluation</h3>
  <fieldset>
    <ul>
      @if (empty($courses->univ))
        <li style='color:red;font-weight:bold;'>No University course selected</li>
      @endif

      @foreach ($courses->univ as $course)
        <li>
          @if (!$closed->univ[$course->id])
            <a href='/eval_index2.php?form=univ&courseId={{ $course->id }}' style='font-weight:bold;'>
              University Course Evaluation : {{ $course->name }}, {{ $course->professor }} @if ($closed->univ[$course->id]) (done) @endif
            </a>
          @else
            University Course Evaluation : {{ $course->name }}, {{ $course->professor }} @if ($closed->univ[$course->id]) (done) @endif
          @endif
        </li>
      @endforeach
    </ul>
  </fieldset>


  {{-- Tutoring --}}

  <h3>Tutorial Evaluations</h3>
  <fieldset>
    <ul>
      <li>
        @if (!$closed->tutoring)
          <a href='/eval_index2.php?form=tutorats' style='font-weight:bold;'>
            Tutorial Evaluations : {{ $tutoring->professor }} @if ($closed->tutoring) (done) @endif
          </a>
        @else
          Tutorial Evaluations : {{ $tutoring->professor }} @if ($closed->tutoring) (done) @endif
        @endif
      </li>
    </ul>
  </fieldset>


  {{-- Workshops --}}

  <h3>Ateliers</h3>
  <fieldset>
    <ul>
      <li>
        @if (!$closed->linguistic)
          <a href='/eval_index2.php?form=linguistique' style='font-weight:bold;'>
            Ateliers Linguistiques @if ($closed->linguistic) (done) @endif
          </a>
        @else
          Ateliers Linguistiques @if ($closed->linguistic) (done) @endif
        @endif
      </li>

      <li>
        @if (!$closed->method)
          <a href='/eval_index2.php?form=method' style='font-weight:bold;'>
            Ateliers Methodologiques @if ($closed->method) (done) @endif
          </a>
        @else
          Ateliers Methodologiques @if ($closed->method) (done) @endif
        @endif
      </li>
    </ul>
  </fieldset>

{{-- @endif ''}} {{-- Semester 2020 --}}


{{-- Internship --}}

@if ($internship->internship == "Yes")
  <h3>Internship Evaluation</h3>
  <fieldset>
    <ul>
      <li>
        @if (!$closed->intership)
          <a href='/eval_index2.php?form=intership' style='font-weight:bold;'>
            Internship Evaluation {{ $internship->name }} @if ($closed->intership) (done) @endif
          </a>
        @else
          Internship Evaluation {{ $internship->name }} @if ($closed->intership) (done) @endif
        @endif
        </li>
    </ul>
  </fieldset>
@endif

@endsection
