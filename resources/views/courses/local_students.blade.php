@extends('layouts.myApp')
@section('content')

  <h3>VWPP Courses for {{ session('semester') }}</h3>
  <fieldset>

    <b>{{ $course->title }}, {{ $course->professor }}</b>
    <br/>

    <div id='course_students_div'>
      <br/>
      <b>Student choice ({{ count($choices) }})</b>
      <br/><br/>

      <table class='datatable'>
        <thead>
          <tr>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Choice</th>
          </tr>
        </thead>

        <tbody>
          @foreach ($choices as $choice)
            <tr>
              <td>{{ $choice->std->lastname }}</td>
              <td>{{ $choice->std->firstname }}</td>
              <td>{!! $choice['choice'] !!}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div id='course_students_div'>
      <br/>
      <b>Final Registration ({{ count ($assignments) }})</b>
      <br/><br/>

      <table class='datatable'>
        <thead>
          <tr>
            <th>Lastname</th>
            <th>Firstname</th>
          </tr>
        </thead>

        <tbody>
          @foreach($assignments as $assignment)
            <tr>
              <td>{{ $assignment->std->lastname }}</td>
              <td>{{ $assignment->std->firstname }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class='align-right'>
      <input type='button' value='Back' onclick='location.href="/courses/home";' class='btn btn-primary' />
    </div>

  </fieldset>

@endsection
